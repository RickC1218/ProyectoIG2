<?php
    require('conexion.php');
    include 'send_mail.php';

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $ci = isset($_POST['ci']) ? $_POST['ci'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $email = isset($_POST['email']) ? $_POST['email']: '';
    $pswd = isset($_POST['pswd']) ? $_POST['pswd'] : '';
    $v_pswd = isset($_POST['v_pswd']) ? $_POST['v_pswd'] : '';
    $msg='';
    $activacion = $email.time();
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
            $body='Hi, <br/> <br/> We need to make sure you are human. Please verify your email and get'.
            'started using your Website account. <br/> <br/> <a href="http://localhost/xampp/ProyectoIG2/activacion.php?code='.$activacion.'">'.$activacion.'</a>';
            Send_Mail($to,$subject,$body);
            $msg= "Registration successful, please activate email.";
            
        }else{
            $msg= "The email is already taken, please try new.";
        }

       
        echo 'ok';
    }else{
        echo'contraseñas no coinciden';
    }
?>
