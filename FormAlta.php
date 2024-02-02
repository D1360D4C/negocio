<?php include('conexionn.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Escaneo de Código de Barras</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/quagga@latest/dist/quagga.min.js"></script>
    
    <div class="formulario">
        <div class= "enviar">

        <form action="conexionn.php" method="post" id="env">
            <input type="text" name="nom" placeholder="Nombre">
            <input type="text" name="mar" placeholder="Marca">
            <input type="text" name="pre" placeholder="Precio" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            <input type="text" name="cod" id="barcode-input" placeholder="Código de Barras">
            <button type="submit" name="guardar">Guardar</button>
            
        </form>
        </div>

        

    </div>

    <button onclick="startScanning()">Escanear Código de Barras</button>
    
    <script language="javascript" type="text/javascript" src="jsc.js"></script>
</body>
</html>