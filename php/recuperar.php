<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require '../template/assets/vendor/PHPMailer/src/PHPMailer.php';
    require '../template/assets/vendor/PHPMailer/src/SMTP.php';
    require '../template/assets/vendor/PHPMailer/src/Exception.php';

    $email = isset($_POST['email']) ? $_POST['email']: '';
    require('conexion.php');

    $sql = "SELECT * FROM CLIENTE WHERE EMAIL_CLI='$email';";
    $result = $conexion->query($sql);
    $resultado = $result -> fetchAll(PDO::FETCH_ASSOC);

    if ( !empty($resultado) ){
        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'topcineEPN@gmail.com';
            $mail->Password = 'hahcjhpwgdamqpru';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('topcineEPN@gmail.com', 'TopCine EPN');
            $mail->addAddress($email, 'Recuperación de cuenta TopCine');

            $mail->isHTML(true);
            $mail->Subject = 'Recuperar cuenta de TopCine';
            $mail->Body = '<b><h2>TopCine:</h2> <h3><i>Anywhere, Anytime, Anyplace</i></b></h3><br>Email: ' . $resultado[0]["EMAIL_CLI"] . '<br>Password: '. $resultado[0]["CONTRASENA_CLI"].'<br><br>Vuelve a intentarlo!';

            $mail->send();
        } catch(Exception $e){
            echo "Error al envío de correo: {$mail->ErrorInfo}";
        }
        echo 'ok';
    } else {
        echo 'Correo: '.$email.' sin cuenta en TopCine, regístrate';
    }
