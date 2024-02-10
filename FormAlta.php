<?php include('conexionn.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <title>Escaneo de Código de Barras</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/quagga@latest/dist/quagga.min.js"></script>
    
    <div class="altaform">
        
        <form class="otro" action="conexionn.php" method="post" id="env">
            <select name="categoria">
            <option value="almacen">Almacen</option>
            <option value="bebida">Bebida</option>
            <option value="galletita">Galletita</option>
            <option value="cigarrillo">Cigarrillo</option>
            <option value="golosina">Golosina</option>
            <option value="limpieza">Limpieza</option>
            
            </select>
            <input type="text" id="campo1" name="nom" placeholder="Nombre">
            <input type="text" id="campo2" name="mar" placeholder="Marca">
            <input type="text" id="campo3" name="pre" placeholder="Precio" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            
            <input type="text" name="cod" id="barcode-input" placeholder="Código de Barras">
            <td><button type="submit" class="boton-des" id="miBoton" name="guardar" disabled>Listo</button> </td>
        </form>
        <button class="botonE" onclick="startScanning(2)">Escanear otra vez</button>
    
    </div>

    
    <script language="javascript" type="text/javascript" src="jsc.js"></script>
    <script language="javascript" type="text/javascript" src="habi.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {startScanning(2);});
    </script>
</body>
</html>