<?php
    session_start();
    require("../Entities/conexion.php");
    $numced = $_SESSION['user'];

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $email = isset($_POST['email']) ? $_POST['email']: '';


    $data = file_get_contents("php://input");
    $sql = "UPDATE cliente SET NOMBRE_CLI='$nombre',APELLIDO_CLI='$apellido',FECHANACIMIENTO_CLI='$fecha', EMAIL_CLI= '$email' 
            WHERE NUMCED_CLI = $numced ";
    $result = $conexion->query($sql);
    echo 'ok';
?>