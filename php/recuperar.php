<?php
    include 'send_mail.php';
    require ('conexion.php');

    $email = isset($_POST['email']) ? $_POST['email']: 'ricardoerazoliga@gmail.com';

    $sql = "SELECT * FROM CLIENTE WHERE EMAIL_CLI='$email';";
    $result = $conexion->query($sql);
    $resultado = $result -> fetchAll(PDO::FETCH_ASSOC);

    if ( !empty($resultado) ){
        $subject = 'Recuperar cuenta de TopCine';
        $body = '<b><h2>TopCine:</h2> <h3><i>Anywhere, Anytime, Anyplace</i></b></h3><br>Email: ' . $resultado[0]["EMAIL_CLI"] 
        . '<br>Password: '. $resultado[0]["CONTRASENA_CLI"].'<br><br>Vuelve a intentarlo!';
        Send_Mail($email, $subject, $body);
    } else {
        echo 'Correo: '.$email.' sin cuenta en TopCine, regístrate';
    }
