<?php
session_start();
$POBLACION=$POBLACIONERR="";
$ENCUENTRAERROR = 0;

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (empty($_POST['POBLACION'])) {
      $POBLACIONERR = "Introduzca una poblacion para poder hacer la consulta";
      $ENCUENTRAERROR = 1;
    } else {
      $POBLACION = test_input($_POST['POBLACION']);
    }
  }
  function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if ($ENCUENTRAERROR == 1) {
    echo $POBLACIONERR;
   } else {
    $POBLACION=strtoupper($POBLACION);
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PERFIL ADMINISTRADOR</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark - usuario.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <section class="login-dark">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">
            <h3 class="navbar-brand"><?php echo $_SESSION['EMAIL']; ?></h3>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="indexAdministrador.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="perfilAdmin.php">Perfil</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="">Administracion </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="añadirUsuario.php">Añadir usuario</a>
                            <a class="dropdown-item" href="#">Borrar usuario</a>
                            <a class="dropdown-item" href="#">Modificar usuario</a>
                            <a class="dropdown-item" href="consultaUsuario.php">Consulta usuarios</a>
                            <!-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Localizacion</a> -->
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log out</a>
                    </li>
                </ul>
                <span class="navbar-text actions"> 
                    <a class="login" href="login.php">Log In</a>
                    <a class="btn btn-light action-button" role="button" href="index.php">Sign Up</a>
                </span>
            </div>
        </div>
    </nav>  
    <br>    
    <div class="containter">
    <table class="table table-dark table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">NOMBRE</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">EMAIL</th>
                <th scope="col">TELEFONO</th>
                <th scope="col">POBLACION</th>
                <th scope="col">PROVINCIA</th>
                <th scope="col">NIF</th>
            </tr>
        </thead>
        <tbody> 
        <?php
        include 'conexion.php';
         //define total number of results you want per page  
        $registros_por_pagina= 3; 
        //determine which page number visitor is currently on  
        if (!isset ($_GET['pagina']) ) {  
            $pagina = 1; 
            $primeraPagina=0; 
        } else {  
           $pagina = $_GET['pagina'];  
        }   
        //determine the sql LIMIT starting number for the results on the displaying page
        $primeraPagina=$pagina*$registros_por_pagina;
        //retrieve the selected results from database
        $query = "SELECT * FROM usuarios WHERE Usuario_poblacion = '$POBLACION' LIMIT $primeraPagina, $registros_por_pagina";  
        $results = $conn->query($query);
        $nRows = $results->num_rows;
        if ($nRows > 0) {
            //display the retrieved result on the webpage   
            while ($row = $results->fetch_array()) {  
                ?>
                <tr class="thead-light borderColor">
                    <th scope="col"><?php echo $row['Usuario_nombre'] ?> </th>
                    <th scope="col"><?php echo $row['Usuario_apellido1'] ?> <?php echo $row['Usuario_apellido2'] ?></th> 
                    <th scope="col"><?php echo $row['Usuario_email'] ?> </th>    
                    <th scope="col"><?php echo $row['Usuario_numero_telefono'] ?> </th>
                    <th scope="col"><?php echo $row['Usuario_poblacion'] ?> </th>
                    <th scope="col"><?php echo $row['Usuario_provincia'] ?> </th>
                    <th scope="col"><?php echo $row['Usuario_nif'] ?> </th>
                </tr>
                <?php
            } 
        } else { 
            ?>
            <tr class="thead-light borderColor">
                <th scope="col" colspan="5"><h2>No hay usuarios de esa poblacion</h2></th>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    
            <?php
        }
        //find the total number of results stored in the database  
        $page_query = "SELECT * FROM usuarios WHERE Usuario_poblacion = '$POBLACION'";
        $page_result = $conn->query($page_query); 
        $total_records = $results->num_rows; 
        $row = $results->fetch_assoc();
        //determine the total number of pages available  
        $total_pages = ceil ($total_records/$registros_por_pagina);
        ?>  
        <nav aria-label="Page navigation">
        <ul class="pagination">
        <?php
        if ($total_pages > 0) {
            if ($pagina !=1) {
            echo "<li class='page-item'><a class=page-link' href='consultaPoblacion.php?pagina=$pagina'>Anterior</a></li>";
            }
            for ($i=1; $i<=$total_pages; $i++) { 
                if ($pagina == $i) {
                echo "<li class='page-item active'><a class='page-link' href='consultaPoblacion.php'>$pagina</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='consultaPoblacion.php?pagina=$i>$i</a></li>";
                } 
        }
        }
        if ($pagina != $total_pages) {
            echo "<li class='page-item' style='border: 1px solid black;'><a class='page-link' href='consultaPoblacion.php?pagina=".($pagina+1)."'>Siguiente</a></li>";
        }    ?>
    </nav>
        </ul>
        </div>
        
    
</div>

</section>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>