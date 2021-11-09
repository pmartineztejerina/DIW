<?php
session_start();
$_SESSION['EMAIL'] = "";
$_SESSION['PASSWORD'] = "";
$_SESSION['USUARIOBLOQUEADO']="visibility: hidden";
/*session is started if you don't write this line can't use $_Session  global variable*/

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LOG IN</title>
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
            <div class="container"><a class="navbar-brand" href="#">FORMULARIO REGISTRO DIW</a>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav me-auto"></ul>
                    <span class="navbar-text actions"> 
                      <a class="login" href="login.php">Log In</a>
                      <a class="btn btn-light action-button" role="button" href="index.php">Sign Up</a>
                    </span>
                </div>
            </div>
        </nav>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2 class="visually-hidden">FORMULARIO LOG IN</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3"><input class="form-control" type="email" name="EMAIL" placeholder="Email" required ></div>
            <div class="mb-3"><input class="form-control" type="password" name="PASSWORD" placeholder="Contraseña" required></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Log In</button></div><a class="forgot" href="#">Forgot your email or password?</a>
        </form>
    </section>
    <div class="modal modal-alert position-fixed d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalChoice" style="background-color: rgba(0, 0, 0, 0.5);<?php echo $_SESSION['USUARIOBLOQUEADO']; ?>">
        <div class="modal-dialog" role="document">
          <div class="modal-content rounded-4 shadow">
            <div class="modal-body p-4 text-center">
              <h5 class="mb-0">Ha excedido los intentos de acceder a la cuenta</h5>
              <p class="mb-0">Contacte con el administrador para su desbloqueo</p>
            </div>
            <div class="modal-footer flex-nowrap p-0">
              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal" onclick="document.getElementById('modalChoice').style.visibility = 'hidden'">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php

include 'conexion.php';

//compruebo si ya esta el mail en la BBDD   
$EMAIL = $PASSWORD = "";
$ENCUENTRAERROR = 0;
$EMAILERR = $PASSWORDERR = "";
$comprobaciones = false;

$INTENTOS = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["EMAIL"])) {
    $EMAILERR = "Email es un campo obligatorio";
    $ENCUENTRAERROR = 1;
  } else {
    $EMAIL = test_input($_POST["EMAIL"]);
  }

  if (empty($_POST['PASSWORD'])) {
    $PASSWORDERR = "La contraseña es un campo obligatorio";
    $ENCUENTRAERROR = 1;
  } else {
    $PASSWORD = test_input($_POST['PASSWORD']);
  }
}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($ENCUENTRAERROR == 1) {
  echo $EMAILERR;
  echo $PASSWORDERR;
} else {

  $sql = "SELECT * FROM usuarios WHERE Usuario_email = '$EMAIL'";

  $results = $conn->query($sql);

  $row = $results->fetch_assoc();

  if ($results->num_rows > 0) {
    $comprobaciones = true;
    $USUARIOBLOQUEADO = $row['Usuario_bloqueado'];
    $INTENTOS=$row['Usuario_numero_intentos'];

      //control de usuario bloqueado
      if ($USUARIOBLOQUEADO == 0) {
        //comprobar la contraseña hasheada
        $CLAVECOMPROBAR = $row['Usuario_clave'];
       /*  echo "Clave de la BBDD ".$CLAVECOMPROBAR;
        echo "Clave que mete ".$PASSWORD;
        echo "recien hasheada".(password_hash($PASSWORD, PASSWORD_DEFAULT)); */
        if (password_verify($PASSWORD, $CLAVECOMPROBAR)) {
          $comprobaciones = true;
          if ($row['Usuario_perfil'] == "admin") {
            $_SESSION["EMAIL"] = $row['Usuario_email'];
            $_SESSION['PERFIL'] = "admin";
            //cookies
            $cookie_name = "cookies";
            $cookie_value = "cookies";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            //campo ultima conexion
            $fechaActual = date('Y-m-d');
            $sql = "UPDATE usuarios SET Usuario_fecha_ultima_conexion = '$fechaActual' WHERE Usuario_email LIKE '$EMAIL'";
            if (!mysqli_query($conn, $sql)) {
              
              echo "no ha añadido la ultima conexion";
              include 'desconexion.php';

            } else {
              //administrador
              $_SESSION["EMAIL"] = $row['Usuario_email'];
              $_SESSION['PERFIL'] = "admin";
              $_SESSION['user_id'] = $row['Usuario_id'];
              $_SESSION['profile_image'] = $row['Usuario_fotografia'];
              include 'desconexion.php';
              $url = "indexAdministrador.php";
              header("Location: " . $url);
              exit();
            }
          } else {
            //usuario
            $_SESSION["EMAIL"] = $row['Usuario_email'];
            $_SESSION['PERFIL'] = "usuario";
            $_SESSION['user_id'] = $row['Usuario_id'];
            $_SESSION['profile_image'] = $row['Usuario_fotografia'];
            include 'desconexion.php';
            $url = "indexUsuario.php";
            header("Location: " . $url);
            exit();
          }
        } else {
          echo "contraseña erronea;
          //controlar los errores";
          $INTENTOS++;
          $sql = "UPDATE usuarios SET Usuario_numero_intentos='$INTENTOS' WHERE Usuario_email LIKE '$EMAIL'";
          if (!mysqli_query($conn, $sql)) {
            echo "no ha añadido el intento";
            include 'desconexion.php';
          }
          //bloquear tras 3 intentos
          $sql = "SELECT * FROM usuarios WHERE Usuario_email = '$EMAIL'";
          $results = $conn->query($sql);
          $row = $results->fetch_assoc(); 

          if ($row['Usuario_numero_intentos'] == 3) {
            $fechaActual = date('Y-m-d');
            $sql = "UPDATE usuarios SET Usuario_bloqueado='1', Usuario_fecha_bloqueo='$fechaActual' WHERE Usuario_email LIKE '$EMAIL'";
            if (mysqli_query($conn, $sql)) {
              echo "Usuario bloqueado";
              //ventana modal por bloqueo de usuario tras tres intentos
              $_SESSION['USUARIOBLOQUEADO']="visibility:visible";
              include 'desconexion.php';
              $url = "login.php";
              header("Location: " . $url);
              exit();
 
            } else {
              echo "No hace el update a usuario bloqueado";
            } 

          }else {
            echo "No ha hecho el bloqueo tras tres intentos";
          }

        }
      } else {
        //¿QUE HACER SI ESTA BLOQUEADO?
        echo "ha entrado en usuario bloqueado";
      }
    
  } else {
    echo "Usuario no registrado";
    include 'desconexion.php';
  }
}
?>