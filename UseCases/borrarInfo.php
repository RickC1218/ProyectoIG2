<?php
    require("../Entities/conexion.php");

    session_start();
    $data = $_SESSION['user'];
    $pdo = $conexion -> prepare("DELETE FROM CLIENTE WHERE NUMCED_CLI = :id");
    $pdo ->bindParam(":id", $data);
    $pdo -> execute();

    $_SESSION = array();
    // Borra la cookie que almacena la sesión
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    session_destroy();
    echo 'ok';
?>