<?php

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $ci = isset($_POST['ci']) ? $_POST['ci'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $email = isset($_POST['email']) ? $_POST['email']: '';
    $pswd = isset($_POST['pswd']) ? $_POST['pswd'] : '';
    $v_pswd = isset($_POST['v-pswd']) ? $_POST['v-pswd'] : '';
    require('conexion.php');

    if (strcmp($pswd,$v_pswd)===0){
        $pdo = $conexion ->prepare('INSERT INTO cliente(NUMCED_CLI, NOMBRE_CLI, APELLIDO_CLI, FECHANACIMIENTO_CLI, EMAIL_CLI, CONTRASENA_CLI) VALUES(?, ?, ?, ?, ?, ?)');
        $pdo->bindParam(1,$ci);
        $pdo->bindParam(2,$nombre);
        $pdo->bindParam(3,$apellido);
        $pdo->bindParam(4,$fecha);
        $pdo->bindParam(5,$email);
        $pdo->bindParam(6,$pswd);
        $pdo->execute() or die(print($pdo->errorInfo()));
        echo 'ok';
    }else{
        echo'contraseñas no coinciden';
    }

?>