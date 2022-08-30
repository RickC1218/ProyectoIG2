<?php
    require("../Entities/conexion.php");

    session_start();
    $data = $_SESSION['user'];
    $pdo = $conexion -> prepare("DELETE FROM CLIENTE WHERE NUMCED_CLI = :id");
    $pdo ->bindParam(":id", $data);
    $pdo -> execute();
    echo 'ok';
?>