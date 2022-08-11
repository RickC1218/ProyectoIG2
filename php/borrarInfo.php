<?php
    session_start();
    $data = $_SESSION['user'];
    require('conexion.php');
    $pdo = $conexion -> prepare("DELETE FROM CLIENTE WHERE NUMCED_CLI = :id");
    $pdo ->bindParam(":id", $data);
    $pdo -> execute();
    echo 'ok';
?>