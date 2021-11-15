<?php 
session_start();
if (!isset($_SESSION['EMAIL'])){
    $_SESSION['EMAIL']="";
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
<?php

$_SESSION['URL']="añadirUsuario.php"; 

?>
        <div class="container">     
        <form action="compRegistroUsuario.php" method="post">
            <h2 class="visually">Crear usuario</h2>
            <div class="illustration">
                <div class="mb-3"><input class="form-control" type="email" name="EMAIL" placeholder="Email" value="" ></div>
                <div class="mb-3"><input class="form-control" type="text" name="PASSWORD" placeholder="Contraseña" value="" ></div>
                <div class="mb-3"><input class="form-control" type="date" name="BIRTHDAY" placeholder="Fecha de nacimiento" value=""></div>
            </div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Crear usuario</button></div>
        </form>
        </div> 
    </section>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
