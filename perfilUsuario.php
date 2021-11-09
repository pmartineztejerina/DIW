<?php 
session_start();
if (!isset($_SESSION['EMAIL'])){
    $_SESSION['EMAIL']="";
    $_SESSION['BIRTHDAY']="";
}
include 'conexion.php';
$NOMBRE=$APELLIDO1=$APELLIDO2=$EMAIL=$DOMICILIO=$POBLACION=$PROVINCIA=$NIF=$TELEFONO=$BIRTHDAY="";
$EMAIL=$_SESSION['EMAIL'];
echo $EMAIL;

$sql = "SELECT * FROM usuarios WHERE 'Usuario_email' = '$EMAIL'";
$results = $conn -> query($sql);
if ($results === false) {
    echo "SQL Error: " . $conn->error;
}
echo $conn->info;


while ($row = $results->fetch_row()) {

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
    <div class="container">
                <h3 class="navbar-brand"><?php echo $_SESSION['EMAIL']; ?></h3>
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="indexUsuario.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="perfilUsuario.php">Perfil</a></li>
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
         <div class="container">     
        <form action="compruebaUsuario.php" method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration">
                <input class="form-control" type="text" name="NOMBRE" placeholder="Nombre" value="<?php echo $row['Usuario_nombre'];?>" >
                <input class="form-control" type="text" name="APELLIDO1" placeholder="Primer apellido" value="<?php echo $row['Usuario_apellido1'];?>" >
                <input class="form-control" type="text" name="APELLIDO2" placeholder="Segundo Apellido" value="<?php echo $row['Usuario_apellido2'];?>" >
                <input class="form-control" type="email" name="EMAIL" placeholder="Email" value="<?php echo $row['Usuario_email'];?>" >
                <input class="form-control" type="text" name="DOMICILIO" placeholder="Domicilio" value="<?php echo $row['Usuario_domicilio'];?>" >
                <input class="form-control" type="text" name="POBLACION" placeholder="Poblacion" value="<?php echo $row['Usuario_poblacion'];?>" >
                <input class="form-control" type="text" name="PROVINCIA" placeholder="Provincia" value="<?php echo $row['Usuario_provincia'];?>" >
                <input class="form-control" type="text" name="NIF" placeholder="NIF" value="<?php echo $row['Usuario_nif'];?>" >
                <input class="form-control" type="text" name="TELEFONO" placeholder="Telefono" value="<?php echo $row['Usuario_telefono'];?>" >
                <input class="form-control" type="date" name="BIRTHDAY" placeholder="Fecha de nacimiento" value="<?php echo $row['Usuario_fecha_nacimiento'];}?>" >
            </div>
            <div class="mb-3"></div>
            <div class="mb-3"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Guardar cambios</button></div>
        </form>
        </div> 
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>