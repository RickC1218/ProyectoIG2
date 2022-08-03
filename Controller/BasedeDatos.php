<?php
$servername = "localhost"; // Nombre/IP del servidor
$database = "TOPCINE"; // Nombre de la BBDD
$username = "Carlos"; // Nombre del usuario
$password = "Linkcar_1999"; // Contraseña del usuario
// Creamos la conexión
$con = mysqli_connect($servername, $username, $password, $database);
// Comprobamos la conexión
if (!$con) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}
#echo "Conexión satisfactoria";
mysqli_set_charset($con,"utf8");