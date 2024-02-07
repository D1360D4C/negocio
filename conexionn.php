<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">Almacén BYA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 200px;">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="FormAlta.php">Nuevo Producto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="FormMod.php">Modificar Precio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="FormConsul.php">Consultar Precio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="FormBaja.php">Eliminar Producto</a>
        </li>
        
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Nombre producto" aria-label="Search">
        <button class="btn btn-outline-success" >Buscar</button>
      </form>
    </div>
  </div>
</nav>

<?php
include_once("cn.php");      

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_GET['form_id']) && $_GET['form_id'] == 'myForm') {
        consultar($conexion);
    }

    if(isset($_POST['guardar'])){
        insertar($conexion);
    }

    if(isset($_POST['borrar'])){
        borrar($conexion);
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
    $cod1 = $_POST['codigo_barras']; 
    $sql = "SELECT nombre, marca, precio FROM productos WHERE codigo='$cod1'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        
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
        echo "No se encontraron productos con ese codigo de barras.";
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>