<?php include('conexionn.php'); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Consultar por Código de Barras</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/quagga@latest/dist/quagga.min.js"></script>
    
    
    <div class= "altaform">
            <form class= "otro" action="conexionn.php?form_id=myForm"  method="post" id="myFormConsulta">  
                <input type="text" name="codigo_barras" id="barcode-input" placeholder="Código de Barras">
                
                <button class="boton-ac" onclick="startScanning(1)">Escaner</button>
            </form>
            
        </div>
    
    
    
    
    <script language="javascript" type="text/javascript" src="jsc.js"></script>
    <script>
     //document.addEventListener('DOMContentLoaded', startScanning);
    document.addEventListener('DOMContentLoaded', function() {
  startScanning(1);
});

    </script>
</body>
</html>