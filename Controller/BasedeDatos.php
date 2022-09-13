<?php
$servername = "bmedwpkvqgclxvayszaa-mysql.services.clever-cloud.com"; // Nombre/IP del servidor
$database = "bmedwpkvqgclxvayszaa"; // Nombre de la BBDD
$username = "u4njwbpubmoozhpo"; // Nombre del usuario
$password = "urZrypNkE3L25QF0n9jx"; // Contraseña del usuario
// Creamos la conexión
$con = mysqli_connect($servername, $username, $password, $database);
$conexion = new PDO('mysql:host=bmedwpkvqgclxvayszaa-mysql.services.clever-cloud.com;port=3306;dbname=bmedwpkvqgclxvayszaa', $username, $password);

// Comprobamos la conexión
if (!$con) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}
// print "Conexión satisfactoria\n";
mysqli_set_charset($con, "utf8");
