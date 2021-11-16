<?php
session_start();
if (!isset($_SESSION['EMAIL'])) {
    $_SESSION['EMAIL'] = "";
    $_SESSION['user_id'] = "";
    $_SESSION['PERFIL'] = "";
}
$EMAILADMIN = $_SESSION['EMAIL'];
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
                                <a class="dropdown-item" href="gestionUsuarios.php">Gestion usuarios</a> 
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
                        <a class="btn btn-primary action-button" role="button" href="index.php">Sign Up</a>
                    </span>
                </div>
            </div>
        </nav>
        <br>
        <div class="container">
            <form action="modifica-borra_Usuarios.php" method="post" name="f1">
                <table class="table table-dark table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>NOMBRE</th>
                            <th scope='col'>APELLIDOS</th>
                            <th scope='col'>EMAIL</th>
                            <th scope='col'>PROVINCIA</th>
                            <th scope='col'>NIF</th>
                            <th scope='col'><input class='btn btn-primary' type='submit' name='btnEliminar' value='Eliminar' /></th>
                        </tr>
                    </thead>
                    <?php

                    include 'conexion.php';
                   
                    $ENCUENTRAERROR=0; 
                    $EMAIL = $PROVINCIA = $NIF ="";
                    if ($_SERVER["REQUEST_METHOD"]=="POST") {
                        $EMAIL = test_input($_POST['EMAIL']);
                        $PROVINCIA = test_input($_POST['PROVINCIA']);
                        $NIF = test_input($_POST['NIF']);
                    }
                    function test_input($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                      } 
                    $EMAIL=strtoupper($EMAIL);  
                    $PROVINCIA=strtoupper($PROVINCIA); 
                    $NIF=strtoupper($NIF);  

                    $sql = 'SELECT * FROM usuarios';
                    $CLAUSES= array();
                    $COLUMN1=$EMAIL;
                    $COLUMN2=$PROVINCIA;
                    $COLUMN3=$NIF;
                    if ( isset($COLUMN1) ) {
                        $CLAUSES[] = '(Usuario_email = "'.$COLUMN1.'")';
                    }
                    if ( isset($COLUMN2) ) {
                        $CLAUSES[] = '(Usuario_provincia = "'.$COLUMN2.'")';
                    }
                    if ( isset($COLUMN3) ) {
                        $CLAUSES[] = '(Usuario_nif = "'.$COLUMN3.'")';
                    } 
                    if ( count($CLAUSES) > 0 ) {
                        $sql .= ' WHERE '.implode(' OR ', $CLAUSES).';';
                    }

                    $results = $conn->query($sql);

                    if ($results->num_rows > 0) {
                        while ($row = $results->fetch_assoc()) {
                            $id = $row['Usuario_id'];
                            $NOMBRE = $row['Usuario_nombre'];
                            $APELLIDO1 = $row['Usuario_apellido1'];
                            $APELLIDO2 = $row['Usuario_apellido2'];
                            $EMAIL = $row['Usuario_email'];
                            $PROVINCIA = $row['Usuario_provincia'];
                            $NIF = $row['Usuario_nif'];

                            echo "<tbody>";
                            echo "
            <tr>
                <td scope='col'>$id</td>
                <td scope='col'>$NOMBRE</td>
                <td scope='col'>$APELLIDO1 $APELLIDO2</td>
                <td scope='col'>$EMAIL</td>
                <td scope='col'>$PROVINCIA</td>
                <td scope='col'>$NIF</td>
                <td scope='col'><input type='checkbox' name='idEliminar[]' value='$id' /></td>
            </tr>";
                        }
                        echo "</tbody></table>";
                    ?>
                       
                        <?php
                    } else {
                        echo "0 results";
                    }
                    include 'desconexion.php';
                        ?>
                </table>
                <div class="mt-5">
                    <button type="button" class="btn btn-primary" onclick="seleccionar_todo()">Marcar Todo</button>
                    <button type="button" class="btn btn-primary" onclick="deseleccionar_todo()">Desmarcar Todo</button>
            </form>
        </div>
        <a class="btn btn-primary" href="indexAdministrador.php">Volver menu</a>
    </section>
    <script type="text/javascript">
          function seleccionar_todo(){
           for (i=0;i<document.f1.elements.length;i++)
              if(document.f1.elements[i].type == 'checkbox')
                 document.f1.elements[i].checked=1
        } 
        function deseleccionar_todo(){
           for (i=0;i<document.f1.elements.length;i++)
              if(document.f1.elements[i].type == 'checkbox')
                 document.f1.elements[i].checked=0
        } 
        </script>
</body>

</html>