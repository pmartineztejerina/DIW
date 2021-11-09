<?php
session_start();
$_SESSION['EMAIL'] = "";

    $ENCUENTRAERROR=0; 
     $NOMBREERR = $APELLIDO1ERR = $APELLIDO2ERR = $EMAILERR= $DOMICILIOERR = $POBLACIONERR = $PROVINCIAERR = $NIFERR = $TELEFONOERR  ="";
     $NOMBRE = $APELLIDO1 = $APELLIDO2 = $EMAIL = $DOMICILIO = $POBLACION = $PROVINCIA = $NIF = $TELEFONO ="";
     if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
      if (empty($_POST["NOMBRE"])) {
        $NOMBREERR="Nombre es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $NOMBRE = test_input($_POST["NOMBRE"]);
      }
      if (empty($_POST['APELLIDO1'])) {
        $APELLIDO_1ERR="El primer apellido es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $APELLIDO_1 = test_input($_POST['APELLIDO1']);
      }
      if (empty($_POST['APELLIDO2'])) {
        $APELLIDO_2ERR="El segundo apellido es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $APELLIDO_2 = test_input($_POST['APELLIDO2']);
      }
      if (empty($_POST['EMAIL'])) {
        $EMAILERR="Email es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $EMAIL = test_input($_POST['EMAIL']);
      }
      if (empty($_POST['DOMICILIO'])) {
        $DOMICILIOERR="Domicilio es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $DOMICILIO = test_input($_POST['DOMICILIO']);
      }
      if (empty($_POST['POBLACION'])) {
        $POBLACIONERR="Poblacion es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $POBLACION = test_input($_POST['POBLACION']);
      }
      if (empty($_POST['PROVINCIA'])) {
        $PROVINCIAERR="Provincia es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $PROVINCIA = test_input($_POST['PROVINCIA']);
      }
      if (empty($_POST['NIF'])) {
        $NIFERR="NIF es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $NIF = test_input($_POST['NIF']);
      }
      if (empty($_POST['TELEFONO'])) {
        $TELEFONOERR="Telefono es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $TELEFONO = test_input($_POST['TELEFONO']);
      }
      if (empty($_POST['BIRTHDAY'])) {
        $BIRTHDAYERR="Cumpleaños es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $BIRTHDAY = test_input($_POST['BIRTHDAY']);
      }
     }
     function test_input($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
     }

     
      //ahora nos conectamos a la base de datos
      //comprobamos si ha encontrado algun error
     if ($ENCUENTRAERROR==1) {
      echo $NOMBREERR;
      echo $APELLIDO1ERR;
      echo $APELLIDO2ERR;
      echo $EMAILERR;
      echo $DOMICILIOERR;
      echo $POBLACIONERR;
      echo $PROVINCIAERR;
      echo $NIFERR;
      echo $TELEFONOERR;
     }
     else {
            
      include 'conexion.php';
      
      $NOMBRE = $_POST['NOMBRE'];
      $APELLIDO1 = $_POST['APELLIDO1'];
      $APELLIDO2 = $_POST['APELLIDO2'];
      $EMAIL = $_POST['EMAIL'];
      $DOMICILIO = $_POST['DOMICILIO'];
      $POBLACION = $_POST['POBLACION'];
      $PROVINCIA = $_POST['PROVINCIA'];
      $NIF = $_POST['NIF'];
      $TELEFONO = $_POST['TELEFONO'];
      $BIRTHDAY = $_POST['BIRTHDAY'];

      //incluir un if para cazar error por campo vacio 
      $sql = "UPDATE usuarios SET Usuario_nombre='$NOMBRE',Usuario_apellido1='$APELLIDO1',Usuario_apellido2='$APELLIDO2',Usuario_email='$EMAIL',Usuario_domicilio='$DOMICILIO',Usuario_poblacion='$POBLACION',Usuario_provincia='$PROVINCIA',Usuario_nif='$NIF',Usuario_numero_telefono='$TELEFONO',Usuario_fecha_nacimiento='$BIRTHDAY' WHERE Usuario_email='$EMAILSESSION'";
    ;

      if (mysqli_query($conn, $sql)) {
        echo "Registro actualizado";
        include 'desconexion.php';
        $_SESSION['NOMBRE']=$NOMBRE;
        $_SESSION['APELLIDO1']=$APELLIDO1;
        $_SESSION['APELLIDO2']=$APELLIDO2;
        $_SESSION['EMAIL']=$EMAIL;
        $_SESSION['DOMICILIO']=$DOMICILIO;
        $_SESSION['POBLACION']=$POBLACION;
        $_SESSION['PROVINCIA']=$PROVINCIA;
        $_SESSION['NIF']=$NIF;
        $_SESSION['TELEFONO']=$TELEFONO;
        $_SESSION['BIRTHDAY']=$BIRTHDAY;
        $url = "perfilUsuario.php";
        header("Location: " . $url);
        exit();
        
      } else {
        echo "Error al completar el perfil del usuario: " . $sql . "<br>" . mysqli_error($con);
        include 'desconexion.php';
        $_SESSION['NOMBRE']=$NOMBRE;
        $_SESSION['APELLIDO1']=$APELLIDO1;
        $_SESSION['APELLIDO2']=$APELLIDO2;
        $_SESSION['EMAIL']=$EMAIL;
        $_SESSION['DOMICILIO']=$DOMICILIO;
        $_SESSION['POBLACION']=$POBLACION;
        $_SESSION['PROVINCIA']=$PROVINCIA;
        $_SESSION['NIF']=$NIF;
        $_SESSION['TELEFONO']=$TELEFONO;
        $_SESSION['BIRTHDAY']=$BIRTHDAY;
        $url = "perfilUsuario.php";
        header("Location: " . $url);
        exit();
        }
      
     
    }
      ?>