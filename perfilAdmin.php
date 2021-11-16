<?php 
session_start();
if (!isset($_SESSION['EMAIL'])){
    $_SESSION['EMAIL']="";
    $_SESSION['NOMBRE'] = "";
    $_SESSION['APELLIDO1'] = "";
    $_SESSION['APELLIDO2'] = "";
    $_SESSION['DOMICILIO'] = "";
    $_SESSION['POBLACION'] = "";
    $_SESSION['PROVINCIA'] = "";
    $_SESSION['NIF'] = "";
    $_SESSION['TELEFONO'] = "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PERFIL ADMINISTRADOR</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min - usuario.css">
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
<?php

$NOMBRE=$_SESSION['NOMBRE'];
$APELLIDO1=$_SESSION['APELLIDO1'];
$APELLIDO2=$_SESSION['APELLIDO2'];
$EMAIL=$_SESSION['EMAIL'];
$DOMICILIO=$_SESSION['DOMICILIO'];
$POBLACION=$_SESSION['POBLACION'];
$PROVINCIA=$_SESSION['PROVINCIA'];
$NIF=$_SESSION['NIF'];
$TELEFONO=$_SESSION['TELEFONO'];

$_SESSION['URL']="perfilAdmin.php"; 

?>
        <div class="container">     
        <form action="compruebaUsuario.php" method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration">
                <input class="form-control" type="text" name="NOMBRE" placeholder="Nombre" value="<?php echo $NOMBRE; ?>" >
                <input class="form-control" type="text" name="APELLIDO1" placeholder="Primer apellido" value="<?php echo $APELLIDO1; ?>" >
                <input class="form-control" type="text" name="APELLIDO2" placeholder="Segundo Apellido" value="<?php echo $APELLIDO2; ?>" >
                <input class="form-control" type="email" name="EMAIL" placeholder="Email" value="<?php echo $EMAIL; ?>" disable >
                <input class="form-control" type="text" name="DOMICILIO" placeholder="Domicilio" value="<?php echo $DOMICILIO; ?>" >
                <input class="form-control" type="text" name="POBLACION" placeholder="Poblacion" value="<?php echo $POBLACION; ?>" >
                <input class="form-control" type="text" name="PROVINCIA" placeholder="Provincia" value="<?php echo $PROVINCIA; ?>" >
                <input class="form-control" type="text" name="NIF" placeholder="NIF" value="<?php echo $NIF; ?>" >
                <input class="form-control" type="text" name="TELEFONO" placeholder="Telefono" value="<?php echo $TELEFONO; ?>" >
                
            </div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Guardar cambios</button></div>
        </form>
        </div> 
    </section>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
