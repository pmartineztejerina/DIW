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
                    <a class="btn btn-light action-button" role="button" href="signUp.php">Sign Up</a>
                </span>
            </div>
        </div>
    </nav>
  <?php
  include 'conexion.php';
    echo "empiezo a comprobar datos";
  $EMAIL = $PASSWORD = $BIRTHDAY = "";
  $ENCUENTRAERROR = $PASSWORDNOVALIDA = 0;
  $EMAILERR = $PASSWORDERR = $BIRTHDAYERR = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['EMAIL'])) {
      $EMAILERR = "Email es un campo obligatorio";
      $ENCUENTRAERROR = 1;
    } else {
      $EMAIL = test_input($_POST['EMAIL']);
    }

    if (empty($_POST['PASSWORD'])) {
      $PASSWORDERR = "La contraseña es un campo obligatorio";
      $ENCUENTRAERROR = 1;
    } else {
      $PASSWORD = test_input($_POST['PASSWORD']);
      if (strlen($PASSWORD )<8) {
        $ENCUENTRAERROR = 1;
        $PASSWORDERR="Minimo 8 carácteres";
      }
      elseif (!preg_match('`[A-Z]`',$PASSWORD)) {
        $ENCUENTRAERROR = 1;
        $PASSWORDERR="Introduce al menos una letra mayúscula";
      }
      elseif (!preg_match('`[a-z]`',$PASSWORD)) {
        $ENCUENTRAERROR = 1;
        $PASSWORDERR="Introduce al menos una letra minúscula";
      }
      elseif (!preg_match('`[0-9]`',$PASSWORD)) {
        $ENCUENTRAERROR = 1;
        $PASSWORDERR="Introduce al menos un número";
      }
    }

    if (empty($_POST['BIRTHDAY'])) {
      $BIRTHDAYERR = "Fecha de nacimiento es un campo obligatorio";
      $ENCUENTRAERROR = 1;
    } else {
      $BIRTHDAY = test_input($_POST['BIRTHDAY']);
    }
  }
  function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($ENCUENTRAERROR == 1) {
    echo $EMAILERR;
    echo $PASSWORDERR;
    echo $BIRTHDAYERR;
  } else {
    echo "entro en comprobar email";
    //compruebo si ya esta el mail en la BBDD
    $sql = "SELECT Usuario_email FROM usuarios WHERE Usuario_email = '$EMAIL'";
    
    $results = $conn->query($sql);
    
    if ($results->num_rows > 0) {
      $_SESSION['EMAIL'] = $EMAIL;
   
      $_SESSION['EMAILEXISTE']= "visibility:visible";

      $_SESSION['BIRTHDAY']=$BIRTHDAY;
      
      include 'desconexion.php'; 
      header("Location: index.php");
    } else {

      $HASH_PASSWORD = password_hash($PASSWORD, PASSWORD_DEFAULT);
      $verification_token = bin2hex(openssl_random_pseudo_bytes(16));
      
      $sql = "INSERT INTO usuarios (Usuario_email, Usuario_clave,Usuario_fecha_nacimiento,Usuario_token_aleatorio,Usuario_bloqueado,Usuario_perfil) VALUES ('$EMAIL', '$HASH_PASSWORD', '$BIRTHDAY','$verification_token','0','usuario')";
      if ($conn->query($sql)===TRUE) {
        echo "Usuario creado correctamente";

        $_SESSION['EMAIL'] = $EMAIL;
        $_SESSION['PASSWORD'] = $PASSWORD;

        include 'desconexion.php';
        $url = "añadirUsuario.php";
        header("Location: " . $url);
        exit();

        //header("Location: login.php");

      /* $sql = "SELECT Usuario_id FROM usuarios WHERE Usuario_email = '$EMAIL'";

      $results = $conn->query($sql);
      
      if ($results->num_rows > 0) {
        // output data of each row
        
          $user_id=$results->fetch_row()[0];
        
        //echo $user_id;
      } else {
        echo "0 results";
      } */

      /* $verification_url = "https://www.pilarmartinez.me/DIW/verify.php?t=$verification_token&user=$user_id";

        $to = $EMAIL;
        $subject = "Confirmacion de registro";
        $message = ' 
                Email de confirmacion de registro  
 
                Bienvenidos a mi correo electronico de prueba. 
                
                Gracias por registrarte en nuestra pagina.
                
                Por favor, pinche en el enlace para confirmar registro.'.  
                
                $verification_url; 

        mail($to,$subject,$message);  */
       
      } else {
        echo "Error al dar de alta al usuario: " . "<br>" . mysqli_error($conn);
        include 'desconexion.php';
      }
      
    }
  }
  

  ?>
</body>
</html>