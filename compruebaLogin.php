<?php
session_start();
$_SESSION['EMAIL'] = "";
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
function test_input($data){
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
        if (password_verify($PASSWORD, $CLAVECOMPROBAR)) {
          $comprobaciones = true;
         
          if ($row['Usuario_perfil'] == "admin" ) {
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
                //aprovecho y saco todos los campos de la BBDD
                $_SESSION['NOMBRE'] = $row['Usuario_nombre'];
                $_SESSION['APELLIDO1'] = $row['Usuario_apellido1'];
                $_SESSION['APELLIDO2'] = $row['Usuario_apellido2'];
                $_SESSION['DOMICILIO'] = $row['Usuario_domicilio'];
                $_SESSION['POBLACION'] = $row['Usuario_poblacion'];
                $_SESSION['PROVINCIA'] = $row['Usuario_provincia'];
                $_SESSION['NIF'] = $row['Usuario_nif'];
                $_SESSION['TELEFONO'] = $row['Usuario_numero_telefono'];

                include 'desconexion.php';
                $url = "indexAdministrador.php";
                header("Location: " . $url);
                exit();
                }
          } if ($row['Usuario_perfil'] == "usuario" ) {
            //usuario
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
                    $_SESSION['EMAIL'] = $row['Usuario_email'];
                    $_SESSION['PERFIL'] = "usuario";
                    $_SESSION['user_id'] = $row['Usuario_id'];
                    $_SESSION['profile_image'] = $row['Usuario_fotografia'];
                    //aprovecho y saco todos los campos de la BBDD
                    $_SESSION['NOMBRE'] = $row['Usuario_nombre'];
                    $_SESSION['APELLIDO1'] = $row['Usuario_apellido1'];
                    $_SESSION['APELLIDO2'] = $row['Usuario_apellido2'];
                    $_SESSION['DOMICILIO'] = $row['Usuario_domicilio'];
                    $_SESSION['POBLACION'] = $row['Usuario_poblacion'];
                    $_SESSION['PROVINCIA'] = $row['Usuario_provincia'];
                    $_SESSION['NIF'] = $row['Usuario_nif'];
                    $_SESSION['TELEFONO'] = $row['Usuario_numero_telefono'];

                    
                    include 'desconexion.php';
                    $url = "indexUsuario.php";
                    header("Location: " . $url);
                    exit();
                }
          } else{
            $url = "login.php";
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