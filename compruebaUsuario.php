<?php
session_start();
if (!isset($_SESSION['EMAIL'])){
  $_SESSION['EMAIL']="";
  $_SESSION['URL']="";
}

$ENCUENTRAERROR=0; 
$NOMBREERR = $APELLIDO1ERR = $APELLIDO2ERR = $DOMICILIOERR = $POBLACIONERR = $PROVINCIAERR = $NIFERR = $TELEFONOERR  ="";
$NOMBRE = $APELLIDO1 = $APELLIDO2 = $DOMICILIO = $POBLACION = $PROVINCIA = $NIF = $TELEFONO ="";
$EMAIL=$_SESSION['EMAIL'];
$url=$_SESSION['URL'];

if ($_SERVER["REQUEST_METHOD"]=="POST") {
      if (empty($_POST['NOMBRE'])) {
        $NOMBREERR="El nombre es un campo obligatorio";
        $ENCUENTRAERROR=1;
      } else {
        $NOMBRE = test_input($_POST['NOMBRE']);
      }
      if (empty($_POST['APELLIDO1'])) {
        $APELLIDO_1ERR="El primer apellido es un campo obligatorio";
        $ENCUENTRAERROR=1;
      } else {
        $APELLIDO1 = test_input($_POST['APELLIDO1']);
      }
      if (empty($_POST['APELLIDO2'])) {
        $APELLIDO_2ERR="El segundo apellido es un campo obligatorio";
        $ENCUENTRAERROR=1;
      } else {
        $APELLIDO2 = test_input($_POST['APELLIDO2']);
      }
      
      if (empty($_POST['DOMICILIO'])) {
        $DOMICILIOERR="Domicilio es un campo obligatorio";
        $ENCUENTRAERROR=1;
      } else {
        $DOMICILIO = test_input($_POST['DOMICILIO']);
      }
      if (empty($_POST['POBLACION'])) {
        $POBLACIONERR="Poblacion es un campo obligatorio";
        $ENCUENTRAERROR=1;
      } else {
        $POBLACION = test_input($_POST['POBLACION']);
      }
      if (empty($_POST['PROVINCIA'])) {
        $PROVINCIAERR="Provincia es un campo obligatorio";
        $ENCUENTRAERROR=1;
      } else {
        $PROVINCIA = test_input($_POST['PROVINCIA']);
      }
      if (empty($_POST['NIF'])) {
        $NIFERR="NIF es un campo obligatorio";
        $ENCUENTRAERROR=1;
      } else {
        $NIF = test_input($_POST['NIF']);
      }
      if (empty($_POST['TELEFONO'])) {
        $TELEFONOERR="Telefono es un campo obligatorio";
        $ENCUENTRAERROR=1;
      } else {
        $TELEFONO = test_input($_POST['TELEFONO']);
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
      echo $DOMICILIOERR;
      echo $POBLACIONERR;
      echo $PROVINCIAERR;
      echo $NIFERR;
      echo $TELEFONOERR;

      echo "encuentra error";
     } else {
            
      include 'conexion.php';
      $NOMBRE=strtoupper($NOMBRE);
      $APELLIDO1=strtoupper($APELLIDO1);
      $APELLIDO2=strtoupper($APELLIDO2);
      $DOMICILIO=strtoupper($DOMICILIO);
      $POBLACION=strtoupper($POBLACION);
      $PROVINCIA=strtoupper($PROVINCIA);
      $NIF=strtoupper($NIF);
      $TELEFONO=strtoupper($TELEFONO);
      
      //incluir un if para cazar error por campo vacio 
      $sql = "UPDATE usuarios SET Usuario_nombre='$NOMBRE',Usuario_apellido1='$APELLIDO1',Usuario_apellido2='$APELLIDO2',Usuario_domicilio='$DOMICILIO',Usuario_poblacion='$POBLACION',Usuario_provincia='$PROVINCIA',Usuario_nif='$NIF',Usuario_numero_telefono='$TELEFONO' WHERE Usuario_email='$EMAIL'";
    
      if (mysqli_query($conn, $sql)) { 
        echo "Registro actualizado";
        include 'desconexion.php';
        $_SESSION['EMAIL']=$EMAIL;
        $_SESSION['PERFIL'] = "usuario";
        $_SESSION['profile_image'] = $row['Usuario_fotografia'];
        $_SESSION['NOMBRE'] = $NOMBRE;
        $_SESSION['APELLIDO1'] = $APELLIDO1;
        $_SESSION['APELLIDO2'] = $APELLIDO2;
        $_SESSION['DOMICILIO'] = $DOMICILIO;
        $_SESSION['POBLACION'] = $POBLACION;
        $_SESSION['PROVINCIA'] = $PROVINCIA;
        $_SESSION['NIF'] = $NIF;
        $_SESSION['TELEFONO'] = $TELEFONO;
              
       
        header("Location: " . $url);
        exit();
        
      } else {
        echo "Error al completar el perfil del usuario: " . $sql . "<br>" . mysqli_error($conn);
        include 'desconexion.php';
        $_SESSION['EMAIL']=$EMAIL;
               
        header("Location: " . $url);
        exit();
      }
  }
