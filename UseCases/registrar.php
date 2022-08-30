<?php
    require("../Entities/conexion.php");
    include 'send_mail.php';

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $ci = isset($_POST['ci']) ? $_POST['ci'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $email = isset($_POST['email']) ? $_POST['email']: '';
    $pswd = isset($_POST['pswd']) ? $_POST['pswd'] : '';
    $v_pswd = isset($_POST['v_pswd']) ? $_POST['v_pswd'] : '';
    $msg='';
    $activacion = md5($email.time());
    //echo $activacion;


    if (strcmp($pswd,$v_pswd)===0){
        //verificacion

        $sql = "SELECT NUMCED_CLI FROM CLIENTE WHERE EMAIL_CLI='$email'";
        $result = $conexion->query($sql);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($resultado)<1){

            $pdo = $conexion ->prepare('INSERT INTO CLIENTE(NUMCED_CLI, NOMBRE_CLI, APELLIDO_CLI, FECHANACIMIENTO_CLI, EMAIL_CLI, CONTRASENA_CLI, ACTIVACION_CLI) VALUES(?, ?, ?, ?, ?, ?, ?)');
            $pdo->bindParam(1,$ci);
            $pdo->bindParam(2,$nombre);
            $pdo->bindParam(3,$apellido);
            $pdo->bindParam(4,$fecha);
            $pdo->bindParam(5,$email);
            $pdo->bindParam(6,$pswd);
            $pdo->bindParam(7,$activacion);
            $pdo->execute() or die(print($pdo->errorInfo()));

            //sending emai;
            $to=$email;
            $subject="Verificacion de email";
            $body=utf8_encode('Hola y bienvenido a una experiencia entre Estrellas...<br/> <br/> 
            Gracias por registrarte con nosotros, para activar tu cuenta por favor coloque Click en el siguiente enlace.<br/> <br/> 
            <a href="http://localhost/xampp/ProyectoIG2/UI/activacion.php?code='.$activacion.'">'.$activacion.'</a> ');
            Send_Mail($to,$subject,$body);
            echo 'ok';
        } else {
            //El email no pudo ser enviado.
            echo 'fail';
        }
    }else{
        echo'contraseñas no coinciden';
    }
?>
