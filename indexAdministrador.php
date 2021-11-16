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
    <title>INDEX ADMINISTRADOR</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
<style>
            .lapiz {
            position: absolute;
            top: 10px;
            left: 140px;
        }
        .cajafoto {
            overflow: hidden;
            margin: 0 auto;
            width: 13rem;
            position: relative;
        }
</style>
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
                               <!--  <div class="dropdown-divider"></div>
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
        <div class="container">
            <div class="intro">
                <h2 class="text-white text-center ">Administrador </h2>
            </div>
            <div class="cajafoto">
                <img class="rounded-circle" src="<?php if(isset($_SESSION['profile_image'])){
                    echo 'uploads/'.$_SESSION['profile_image'];} else{echo 'assets/img/1.jpg';}?>" width="200" height="200">
            </div>
            <div class="mb-3 upload_form">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <?php $_SESSION['URL']="indexAdministrador.php";  ?>
                    <h2 class="visually-hidden">Login Form</h2>
                    <div class="illustration">
                        <input class="form-control" type="file" name="imageUpload" id="fileUpload" placeholder="Seleccione archivo">
                    </div>
                    <div class="mb-3"></div>
                    <div class="mb-3"></div>
                    <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" name="submit" id="save">Guardar cambios</button></div>
                </form>
            </div>
        </div>
</section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>