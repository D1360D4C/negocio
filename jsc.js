async function startScanning(parametro) {
  
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
          readers: ['upc_reader', 'code_128_reader', 'ean_reader', 'code_39_reader'] // Agrega otros tipos de códigos de barras si es necesario
        },
        locate: true,
        numOfWorkers: 4,
        locator: {
          halfSample: true,
          patchSize: 'medium' // Puedes ajustar el tamaño del parche según tu escenario
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
