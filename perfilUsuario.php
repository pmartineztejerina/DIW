<?php 
session_start();
if (!isset($_SESSION['EMAIL'])){
    $_SESSION['EMAIL'] = "";
    $_SESSION['BIRTHDAY']="";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
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
            <div class="container"><a class="navbar-brand" href="#">FORMULARIO USUARIO</a>
                <div class="collapse navbar-collapse" id="navcol-1">
                </div>
            </div>
        </nav>
         <div class="container">     
        <form action="compruebaUsuario.php" method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration">
                <input class="form-control" type="text" name="NOMBRE" placeholder="Nombre">
                <input class="form-control" type="text" name="APELLIDO1" placeholder="Primer apellido">
                <input class="form-control" type="text" name="APELLIDO2" placeholder="Segundo Apellido">
                <input class="form-control" type="email" name="EMAIL" placeholder="Email" value="<?php echo $_SESSION['EMAIL']; ?>">
                <input class="form-control" type="text" name="DOMICILIO" placeholder="Domicilio">
                <input class="form-control" type="text" name="POBLACION" placeholder="Poblacion">
                <input class="form-control" type="text" name="PROVINCIA" placeholder="Provincia">
                <input class="form-control" type="text" name="NIF" placeholder="NIF">
                <input class="form-control" type="text" name="TELEFONO" placeholder="Telefono">
                <input class="form-control" type="date" name="BIRTHDAY" placeholder="Fecha de nacimiento" value="<?php echo $_SESSION['BIRTHDAY']; ?>"></div>
            <div class="mb-3"></div>
            <div class="mb-3"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Guardar cambios</button></div>
        </form>
        </div> 
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>