<?php
    session_start();
    $email = isset($_POST['email']) ? $_POST['email']: '';
    $pswd = isset($_POST['pswd']) ? $_POST['pswd'] : '';
    require('conexion.php');

    $sql = "SELECT EMAIL_CLI, CONTRASENA_CLI, NUMCED_CLI FROM CLIENTE WHERE EMAIL_CLI='$email'";
    $result = $conexion->query($sql);
    $resultado = $result -> fetchAll(PDO::FETCH_ASSOC);

    if ($email === $resultado[0]['EMAIL_CLI']){
        if ($pswd === $resultado[0]['CONTRASENA_CLI']){
            $_SESSION['user'] = $resultado[0]['NUMCED_CLI'];
            if (isset($_COOKIE[$resultado[0]['NUMCED_CLI']])){
                setcookie($resultado[0]['NUMCED_CLI'], $_COOKIE[$resultado[0]['NUMCED_CLI']] + 1, time()+3600,"/");
            }else{
                setcookie($resultado[0]['NUMCED_CLI'], 1, time()+3600,"/");
            }
            echo 'ok';
        }else{
            echo 'fail';
        }
    }else{
        echo 'fail';
    }
    //cookies
?>