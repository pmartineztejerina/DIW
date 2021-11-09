<?php
session_start();
if (!isset($_SESSION['EMAIL'])) {
  $_SESSION['EMAIL'] = "";
  $_SESSION['user_id']="";
  $_SESSION['URL']="";
}

//codigo upload
$target_file = "uploads/".basename($_FILES['imageUpload']['name']);
$punto=".";
$extension=end(explode($punto,$target_file));
$newFilename=$_SESSION['user_id'].".".$extension;
$uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST['submit'])) {
  $check = getimagesize($_FILES['imageUpload']['tmp_name']);
  if($check !== false) {
    echo "File is an image - " . $check['mime'] . ".";
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
if ($_FILES['imageUpload']['size'] > 500000) {
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
  if (move_uploaded_file($_FILES['imageUpload']['tmp_name'], "uploads/".$newFilename)) {
    include 'conexion.php';
    $EMAILSESSION=$_SESSION['EMAIL']; 
    $sql= "UPDATE usuarios SET Usuario_fotografia='$newFilename' WHERE Usuario_email='$EMAILSESSION'";
    if (mysqli_query($conn, $sql)) {      
      echo "Foto subida a la bbdd";
      include 'desconexion.php';
      $url = $_SESSION['URL'];
      Header('Location: '.$url);
      Exit(); 

    } else {
      echo "La foto no se ha subido a la bbdd";
      include 'desconexion.php';
      $url = $_SESSION['URL'];
      Header('Location: '.$url);
      Exit(); 
    }

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>