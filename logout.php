<?php
session_start();
// remove all session variables
session_unset();

// destroy the session
session_destroy();

$url = "login.php";
header("Location: " . $url);
exit();

?>
