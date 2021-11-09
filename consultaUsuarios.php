<?php
session_start();

include 'conexion.php';
$sql = "SELECT * FROM usuarios";

$results = mysqli_query($conn, $sql) or
    die("Problemas en el select:" . mysqli_error($conn));

if (mysqli_num_rows($results) > 0) {
    echo
    "<table class='tabla'>
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
