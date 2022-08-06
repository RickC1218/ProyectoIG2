<?php

    $email = isset($_POST['email']) ? $_POST['email']: '';
    $pswd = isset($_POST['pswd']) ? $_POST['pswd'] : '';
    require('conexion.php');


    $sql = "SELECT EMAIL_CLI, CONTRASENA_CLI FROM cliente WHERE EMAIL_CLI='$email'";
    $result = $conexion->query($sql);
    $resultado = $result -> fetchAll(PDO::FETCH_ASSOC);

    if ($email === $resultado[0]['EMAIL_CLI']){
        if ($pswd === $resultado[0]['CONTRASENA_CLI']){
            echo 'ok';
        }else{
            echo 'fail';
        }
    }else{
        echo 'fail';
    }

?>