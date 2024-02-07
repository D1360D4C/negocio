<?php include('conexionn.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Eliminar por Código de Barras</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/quagga@latest/dist/quagga.min.js"></script>
    
    <div class="formulario">
    <div class= "altaform">
            <form action="conexionn.php" method="post" id="borrar">
                <input type="text" name="nombre1" placeholder="Nombre">
                <input type="text" name="codi" id="barcode-input" placeholder="Código de Barras">
                <button type="submit" name="borrar">Borrar</button>
            </form>
            <button onclick="startScanning(2)">Escanear Código de Barras</button>
        </div>
    </div>
    
    <script language="javascript" type="text/javascript" src="jsc.js"></script>
</body>
</html>

