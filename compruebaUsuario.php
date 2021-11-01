<?php
    $ENCUENTRAERROR=0; 
     $NOMBREERR = $APELLIDO_1ERR = $APELLIDO_2ERR = $DOMICILIOERR = $POBLACIONERR = $PROVINCIAERR = $NIFERR = $TELEFONOERR  ="";
     $NOMBRE = $APELLIDO_1 = $APELLIDO_2 = $DOMICILIO = $POBLACION = $PROVINCIA = $NIF = $TELEFONO = $FOTO ="";
     if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
      if (empty($_POST["NOMBRE"])) {
        $NOMBREERR="Nombre es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $NOMBRE = test_input($_POST["NOMBRE"]);
      }
      if (empty($_POST['APELLIDO_1'])) {
        $APELLIDO_1ERR="El primer apellido es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $APELLIDO_1 = test_input($_POST['APELLIDO_1']);
      }
      if (empty($_POST['APELLIDO_2'])) {
        $APELLIDO_2ERR="El segundo apellido es un campo obligatorio";
        $ENCUENTRAERROR=1;
      }
      else {
        $APELLIDO_2 = test_input($_POST['APELLIDO_2']);
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
     
      function mostrardatos()
      {
        include 'conexion.php';
        $sql = "SELECT * FROM usuarios";

        $results = mysqli_query($conn, $sql) or
          die("Problemas en el select:" . mysqli_error($conn));

        if (mysqli_num_rows($results) > 0) {
          echo "<table class='tabla'>
          <tr>
          <th> NOMBRE </th>
          <th> APELLIDO_1 </th>
          <th> APELLIDO_2 </th>
          <th> EMAIL </th>
          <th> DOMICILIO </th>
          <th> POBLACION </th>
          <th> PROVINCIA </th>
          <th> NIF </th>
          <th> TELEFONO </th>
          <th> FECHA_NACIMIENTO </th>
          </tr>";

          while ($row = mysqli_fetch_assoc($results)) {

            echo "<tr>
            <td> " . $row["NOMBRE"] . "</td>
            <td> " . $row["APELLIDO_1"] . "</td>
            <td> " . $row["APELLIDO_2"] . "</td>
            <td> " . $row["EMAIL"] . "</td>
            <td> " . $row["DOMICILIO"] . "</td>
            <td> " . $row["POBLACION"] . "</td>
            <td> " . $row["PROVINCIA"] . "</td>
            <td> " . $row["NIF"] . "</td>
            <td> " . $row["TELEFONO"] . "</td>   
            <td> " . $row["BIRHTDAY"] . "</td>     
            </tr>";
          }
        } else {
          echo "0 results";
        }
        echo "</table>";
        mysqli_close($conn);
      }
      //aqui se cierra la funcion mostrardatos

      //ahora nos conectamos a la base de datos
      //comprobamos si ha encontrado algun error
     if ($ENCUENTRAERROR==1) {
      echo $NOMBREERR;
      echo $APELLIDO_1ERR;
      echo $APELLIDO_2ERR;
      echo $DOMICILIOERR;
      echo $POBLACIONERR;
      echo $PROVINCIAERR;
      echo $NIFERR;
      echo $TELEFONOERR;
     }
     else {
            
        include 'conexion.php';
      
      $NOMBRE = $_POST['NOMBRE'];
      $APELLIDO_1 = $_POST['APELLIDO_1'];
      $APELLIDO_2 = $_POST['APELLIDO_2'];
      $EMAIL = $_POST['EMAIL'];
      $DOMICILIO = $_POST['DOMICILIO'];
      $POBLACION = $_POST['POBLACION'];
      $PROVINCIA = $_POST['PROVINCIA'];
      $NIF = $_POST['NIF'];
      $TELEFONO = $_POST['TELEFONO'];
      $BIRTHDAY = $_POST['BIRTHDAY'];

      //incluir un if para cazar error por campo vacio 
      $sql = "INSERT INTO usuarios (Usuario_nombre,Usuario_apellido1,Usuario_apellido2,Usuario_email,Usuario_domicilio,Usuario_poblacion,Usuario_provincia,Usuario_nif,Usuario_numero_telefono,Usuario_fecha_nacimiento) 
      VALUES ('$NOMBRE', '$APELLIDO_1', '$APELLIDO_2', '$EMAIL' , '$DOMICILIO' ,'$POBLACION','$PROVINCIA','$NIF','$TELEFONO','$BIRTHDAY')";

      if (mysqli_query($conn, $sql)) {
        echo ""; //"<h4>Nuevo registro creado correctamente</h4>";
        
      } else {
        echo "Error al dar de alta el libro: " . $sql . "<br>" . mysqli_error($con);
       
      }
      mysqli_close($conn);
      //ahora llamamos a la funcion de mostrar datos, tras habernos conectado a nuestra bdd
      mostrardatos();
    }
      ?>