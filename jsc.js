async function startScanning(parametro) {
  //toggleFlash();
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });

      // Mostrar la vista previa de la cámara
      const cameraPreview = document.createElement('video');
      cameraPreview.setAttribute('id', 'camera-preview');
      document.body.appendChild(cameraPreview);
      cameraPreview.srcObject = stream;
      cameraPreview.play();

      // Configurar QuaggaJS
      Quagga.init({
        inputStream: {
          name: 'Live',
          type: 'LiveStream',
          target: cameraPreview
        },
        decoder: {
          readers: ['code_128_reader', 'ean_reader']
        }
      }, function (err) {
        if (err) {
          console.error(err);
          return;
        }
        Quagga.start();
      });

      Quagga.onDetected(function (data) {
        const barcode = data.codeResult.code;
        document.getElementById('barcode-input').value = barcode;
        
        Quagga.stop();
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
        playBeepSound();
        playsape();
        if(parametro == 1){
        document.getElementById('myFormConsulta').submit();
        }
        document.body.removeChild(cameraPreview);
        
      });
    } catch (error) {
      console.error('Error al acceder a la cámara:', error);
    }
  }

  function playBeepSound() {
    let beepAudio = new Audio('beep4.mp3'); 
    beepAudio.play();
  }
  function playsape() {
    let beepAudio = new Audio('sape.mp3'); 
    beepAudio.play();
  }

  
  async function toggleFlash() {
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
      const track = stream.getVideoTracks()[0];
  
      if (!('capabilities' in track) || !track.capabilities.torch) {
        alert('El flash no es compatible en este dispositivo o navegador.');
        return;
      }
  
      // Verificar si el flash está encendido o apagado y cambiar su estado
      if (track.getSettings().torch === true) {
        await track.applyConstraints({ advanced: [{ torch: false }] });
        alert('Flash apagado.');
      } else {
        await track.applyConstraints({ advanced: [{ torch: true }] });
        alert('Flash encendido.');
      }
    } catch (error) {
      console.error('Error al acceder a la cámara:', error);
      alert('Error al acceder a la cámara. Por favor, asegúrate de conceder los permisos necesarios.');
    }
  }