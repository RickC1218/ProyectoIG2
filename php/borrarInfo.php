<?php
    $data = file_get_contents("php://input");
    require('conexion.php');
    $pdo = $conexion -> prepare("DELETE FROM CLIENTE WHERE NUMCED_CLI = :id");
    $pdo ->bindParam(":id", $data);
    $pdo -> execute();
    echo 'ok';
?>