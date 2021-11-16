<?php
session_start();
if (!isset($_SESSION['EMAIL'])) {
    $_SESSION['EMAIL'] = "";
    $_SESSION['user_id']="";
    $_SESSION['PERFIL'] ="";
}
$EMAILADMIN=$_SESSION['EMAIL'];
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
    <?php
    include 'conexion.php';

    $sql = "SELECT *
            FROM usuarios 
            WHERE Usuario_email  NOT LIKE '$EMAILADMIN'";
    $results = $conn->query($sql);
?>
<div class="container">
    <form action="modifica-borra_Usuarios.php" method="post">
    <table class="table table-dark table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope='col'>ID</th>    
            <th scope='col'>EMAIL</th>
            <th scope='col'>PERFIL</th>
            <th scope='col'>BLOQUEADO</th>
            <th scope='col'><input class='btn btn-primary' type='submit' name='btnEliminar' value='Eliminar' /></th>
            <th scope='col'><input class='btn btn-primary' type='submit' name='btnDesbloquear' value='Desbloquear' /></th>
            <th scope='col'><input class='btn btn-primary' type='submit' name='btnModificar' value='Modificar perfil' /></th>
        </tr>
        </thead>
<?php
    if ($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
            $id= $row['Usuario_id'];
            $EMAIL = $row['Usuario_email'];
            $PERFIL = $row['Usuario_perfil'];
            $BLOQUEADO = $row['Usuario_bloqueado'];

            if ($BLOQUEADO=="0") {
                $cadena = "No";
            } else if ($BLOQUEADO=="1") {
                $cadena = "Si";
            }
            echo "<tbody>";
            echo "
            
            <tr>
                <td scope='col'>$id</td>
                <td scope='col'>$EMAIL</td>
                <td scope='col'>$PERFIL</td>
                <td scope='col'>$cadena</td>
                <td scope='col'><input type='checkbox' name='idEliminar[]' value='$id' /></td>
                <td scope='col'><input type='checkbox' name='idDesbloquear[]' value='$id' /></td>
                <td scope='col'><input type='checkbox' name='idModificar[]' value='$id' /></td>
            </tr>";
        }
            echo "</tbody></table>";
    } else {
        echo "0 results";
    }
    $conn->close();

?>
    </table>
    </form>
    <a class="btn btn-primary" href="indexAdministrador.php">Volver menu</a>
</div> 

</section>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>