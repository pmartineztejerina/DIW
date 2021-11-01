<?php 
session_start();
if (!isset($_SESSION['EMAIL'])){
    $_SESSION['EMAIL'] = "";

}
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
</head>

<body>
    <section class="login-dark">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">
            <h3 class="navbar-brand"><?php echo $_SESSION['EMAIL']; ?></h3>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="perfilAdmin.php">Perfil</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Administracion </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Añadir usuario</a>
                            <a class="dropdown-item" href="#">Borrar usuario</a>
                            <a class="dropdown-item" href="#">Modificar usuario</a>
                            <a class="dropdown-item" href="#">Desbloquear usuario</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Localizacion</a>
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
    <div class="container">
            <div class="intro">
                <h2 class="text-white text-center ">Administrador </h2>
            </div>
            <div class="row people">
                <div class="col-md-3 col-lg-3 item mx-auto">
                    <div class="box"><img class="rounded-circle" src="$_SESSION['FILE]" >
                    </div>
                </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration">
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" placeholder="Seleccione archivo" ></div>
            <div class="mb-3"></div>
            <div class="mb-3"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Guardar cambios</button></div>
        </form>
        </div>  
    </section>
</body>
</html>
<?php

include 'conexion.php';

//codigo upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    header("Location: indexAdministrador.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>