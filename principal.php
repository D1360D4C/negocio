<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="letra" href="principal.php">Almacén BYA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">

    <form  action="principal.php" method="post" id= "cat">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 500px;">
        <li>
            <button type="submit" name="Almacen" class="ww">Almacen</button>
        </li>
        <li>
            <button type="submit" name="Bebidas" class="ww" >Bebibas</button>
        </li>
        <li>
            <button type="submit" name="Galletitas" class="ww" >Galletitas</button>
        </li>
        <li>
            <button type="submit" name="Cigarrillos" class="ww" >Cigarrillos</button>   
        </li>
        <li>
            <button type="submit" name="Golosinas" class="ww" >Golosinas</button>
        </li>
        <li>
            <button type="submit" name="Limpieza" class="ww" >Limpieza</button>
        </li>
        </form>
      </ul>
      <div class="costado">
        <form action="principal.php" method="post" id= "buscar" class="d-flex" role="search">
          <input class= "ww" type="text" name="nombreBusca" placeholder="Nombre producto">
          <button class="ww" type="submit" name="buss" >Buscar</button>
        </form>
      </div>
    </div>
  </div>
</nav>

<?php
include_once("connection.php");      

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['Almacen']) || isset($_POST['Bebidas']) || isset($_POST['Limpieza']) || isset($_POST['Galletitas']) || isset($_POST['Cigarrillos']) || isset($_POST['Golosinas'])){
    
      if(isset($_POST['Almacen'])) {
        $tipo = "Almacen";
    } elseif(isset($_POST['Bebidas'])) {
        $tipo = "Bebidas";
    } elseif(isset($_POST['Galletitas'])) {
        $tipo = "Galletitas";
    } elseif(isset($_POST['Cigarrillos'])) {
        $tipo = "Cigarrillos";
    } elseif(isset($_POST['Golosinas'])) {
        $tipo = "Golosinas";
    }elseif(isset($_POST['Limpieza'])) {
      $tipo = "Limpieza";
    }
      consultar($conn, $tipo);
    }
    
    if(isset($_POST['buss'])){
      $tipo = "buscarN";
      consultar($conn, $tipo);
    }

    }

function consultar($conexion, $tipo){
 
  if($tipo == "buscarN"){
    $nomB = $_POST['nombreBusca']; 
    $sql = "SELECT nombre, marca, precio FROM productos WHERE nombre='$nomB'";
    $result = $conexion->query($sql);
  }
  else if($tipo == "Almacen" || $tipo == "Galletitas" || $tipo == "Bebidas" || $tipo == "Cigarrillos" || $tipo == "Golosinas" || $tipo == "Limpieza"){
    $sql = "SELECT nombre, marca, precio FROM productos WHERE categoria='$tipo'";
    $result = $conexion->query($sql);
  }
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
        mostrar();
    }
}

function mostrar(){
    $servername = "localhost";
    $dBUsername = "id20779728_diegocallamullo";
    $dBPassword = "E5p32arduino$";
    $dBName = "id20779728_esp32";

    $conex = new mysqli($servername, $dBUsername, $dBPassword, $dBName);
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
                    font-weight: bold;
                    padding: 16px;
                    text-align: left;
                    border-bottom: 2px solid #ddd;
                }
    
                th {
                    background-color: #042a7c;
                    color: #ffffff;
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
        echo "No se encontraron productos.";
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>