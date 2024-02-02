async function startScanning() {
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

      // Escuchar eventos de detección de código de barras
      Quagga.onDetected(function (data) {
        const barcode = data.codeResult.code;
        document.getElementById('barcode-input').value = barcode;

        // Detener Quagga después de encontrar un código de barras
        Quagga.stop();

        // Detener la transmisión de la cámara
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());

        // Eliminar la vista previa de la cámara
        document.body.removeChild(cameraPreview);
      });
    } catch (error) {
      console.error('Error al acceder a la cámara:', error);
    }
  }

  function cerrarPagina() {
    window.open('', '_self', '');  // Abre una página en blanco en la misma ventana
    window.close();  // Cierra la página actual
    console.error('Error al acceder a la cámara:', error);
  }