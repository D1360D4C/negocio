<?php include('conexionn.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Modificar por Código de Barras</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/quagga@latest/dist/quagga.min.js"></script>
    
    <div class="formulario">
    <div class= "modificar">
            <form action="conexionn.php" method="post" id="modificar">
                
                <input type="text" name="codi" id="barcode-input" placeholder="Código de Barras">
                <input type="text" name="precio2" placeholder="Nuevo Precio">
                <button type="submit" name="modif">Listo</button>

            </form>
        </div>
    </div>

    <button onclick="startScanning()">Escanear Código de Barras</button>
    
    <script language="javascript" type="text/javascript" src="jsc.js"></script>
</body>
</html>
