<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    function sendEmail(){
        require '../pdf/conexion.php';

        $consulta = $pdo->prepare("SELECT EMAIL_CLI, NUMCED_CLI FROM CLIENTE WHERE NUMCED_CLI = 1726639410;");
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        $mail = new PHPMailer(true);
        try{
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'topcineEPN@gmail.com';
            $mail->Password = 'hahcjhpwgdamqpru';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('topcineEPN@gmail.com', 'TopCine EPN');
            $mail->addAddress($resultado[0]['EMAIL_CLI'], 'COMPRAS TOPCINE');

            $mail->addAttachment('../email/docs/factura'.$resultado[0]["NUMCED_CLI"].'.pdf', 'Factura.pdf');
            $mail->isHTML(true);
            $mail->Subject = 'Factura de compra TopCine';
            $mail->Body = utf8_decode('<h4>Gracias por tu compra, disfruta tu película con </h4><h2><b>TopCine:<h2> <h3><i>Anywhere, Anytime, Anyplace</i></b><h3>');
            
            $mail->send();
            echo 'Correo enviado';

        } catch(Exception $e){
            echo "Error al envío de correo: {$mail->ErrorInfo}";
        }
    }
