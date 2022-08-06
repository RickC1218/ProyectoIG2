<?php

    $email = isset($_POST['email']) ? $_POST['email']: '';
    $pswd = isset($_POST['pswd']) ? $_POST['pswd'] : '';
    require('conexion.php');

    $pdo = $conexion ->prepare('SELECT EMAIL_CLI, CONTRASENA_CLI FROM cliente WHERE cliente.EMAIL_CLI=, CONTRASENA_CLI');
    $pdo->bindParam(1,$ci);
    $pdo->bindParam(2,$nombre);
    $pdo->bindParam(3,$apellido);
    $pdo->bindParam(4,$fecha);
    $pdo->bindParam(5,$email);
    $pdo->bindParam(6,$pswd);
    $pdo->execute() or die(print($pdo->errorInfo()));
    echo 'ok';
?>