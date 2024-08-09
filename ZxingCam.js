async function startScanning() {
    try {
      // Solicitar acceso a la cámara
      const stream = await navigator.mediaDevices.getUserMedia({
        video: {
          facingMode: { exact: "environment" } // Acceder a la cámara trasera
        }
      });
      const cameraPreview = document.createElement('video');
      cameraPreview.setAttribute('id', 'camera-preview');
      document.body.appendChild(cameraPreview);
      cameraPreview.srcObject = stream;
      cameraPreview.play();

      // Crear un lector de códigos de barras
      const codeReader = new ZXing.BrowserBarcodeReader();

      // Escuchar eventos de detección de código de barras
      codeReader.decodeFromVideoElement(cameraPreview, (result, err) => {
        if (result) {
            const barcode = result.text;
            document.getElementById('barcode-input').value = barcode;
  
            // Detener la transmisión de la cámara
            const tracks = stream.getTracks();
            tracks.forEach(track => track.stop());
  
            // Eliminar la vista previa de la cámara
            document.body.removeChild(cameraPreview);
          } else if (err) {
            console.error('Error al escanear:', err);
          }
        });
      } catch (error) {
        console.error('Error al acceder a la cámara:', error);
      }
    }