<?php
session_start();
$_SESSION['EMAIL'] = "";
// remove all session variables
$EMAIL=$_SESSION['EMAIL'];
echo $EMAIL;
session_unset();

// destroy the session
session_destroy();

include 'conexion.php';
$sql = "UPDATE usuarios SET Usuario_numero_intentos='0' WHERE Usuario_email LIKE '$EMAIL'";
    if (!mysqli_query($conn, $sql)) {
        echo "no ha reseteado los intentos";
        include 'desconexion.php';
    }
    else {
        
    }


$url = "login.php";
header("Location: " . $url);
exit();

?>
