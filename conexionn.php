<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="index.html"><button>Home</button></a>
<a href="FormAlta.php"><button>Nuevo Producto</button></a>
<a href="FormBaja.php"><button>Eliminar Producto</button></a>
<a href="FormConsul.php"><button>Consultar Precio</button></a>
<a href="FormMod.php"><button>Modificar Precio</button></a>

<?php
include_once("cn.php");      

bifur($conexion);

function bifur($conexion){
    if(isset($_POST['guardar'])){
        insertar($conexion);
    }

    if(isset($_POST['borrar'])){
        borrar($conexion);
    }
    if(isset($_POST['consultar1'])){
        consultar($conexion);
    }
    if(isset($_POST['modif'])){
        modificar($conexion);
    }
}
function insertar($conexio){
    $nombre = $_POST['nom'];
    $marca = $_POST['mar'];
    $precio = $_POST['pre'];
    $codigo = $_POST['cod'];

    $consulta = "INSERT INTO productos(nombre,marca,precio,codigo) VALUES ('$nombre', '$marca', '$precio', '$codigo')";

    mysqli_query($conexio,$consulta);
    mysqli_close($conexio);
    echo "<p>Producto: $nombre ¡Agregado!</p>";
    mostrar();
}

function borrar($conexion){
    $cod = $_POST['codi']; 
    $consulta = "DELETE FROM productos WHERE codigo='$cod'";
    mysqli_query($conexion,$consulta);
    mysqli_close($conexion);
    mostrar();
}

function modificar($conexion){
    $cod = $_POST['codi']; 
    $precio2 = $_POST['precio2']; 
    //UPDATE nombre_tabla SET precio = nuevo_valor WHERE codigo = 'x';

    $consulta = "UPDATE productos SET precio = '$precio2' WHERE codigo='$cod'";
    mysqli_query($conexion,$consulta);
    mysqli_close($conexion);
    mostrar();
}

function consultar($conexion){
    $cod1 = $_POST['codi']; 
    $conex = new mysqli('localhost','root','','prueba');
    $sql = "SELECT nombre, marca, precio FROM productos WHERE codigo='$cod1'";
    $result = $conex->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        // MUESTRA los datos en una tabla con estilos CSS
        echo "<style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
    
                th, td {
                    padding: 12px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
    
                th {
                    background-color: #f2f2f2;
                }
              </style>";
    
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Marca</th><th>Precio</th></tr>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["marca"] . "</td>
                    <td>" . $row["precio"] . "</td>
                  </tr>";
        }
    
        echo "</table>";
    } else {
        echo "No se encontraron usuarios.";
    }
}

function mostrar(){
    
    $conex = new mysqli('localhost','root','','prueba');
    $sql = "SELECT nombre, marca, precio FROM productos";
    $result = $conex->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        // MUESTRA los datos en una tabla con estilos CSS
        echo "<style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
    
                th, td {
                    padding: 12px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
    
                th {
                    background-color: #f2f2f2;
                }
              </style>";
    
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Marca</th><th>Precio</th></tr>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["marca"] . "</td>
                    <td>" . $row["precio"] . "</td>
                  </tr>";
        }
    
        echo "</table>";
    } else {
        echo "No se encontraron usuarios.";
    }
}
?>

</body>
</html>