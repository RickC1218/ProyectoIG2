<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../template/assets/vendor/PHPMailer/src/PHPMailer.php';
    require '../template/assets/vendor/PHPMailer/src/SMTP.php';
    require '../template/assets/vendor/PHPMailer/src/Exception.php';



    //Send_Mail('leomijail@hotmail.com','Recuperar cuenta de TopCine1','Envio de prueba','Recuperación de cuenta TopCine2');

    function Send_Mail($to,$subject,$body){
        $from       = "topcineEPN@gmail.com";
        $mail       = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Host       = "smtp.gmail.com"; // SMTP host
        $mail->Port       =  587;                    // set the SMTP port
        $mail->Username   = "topcineEPN@gmail.com";  // SMTP  username
        $mail->Password   = "hahcjhpwgdamqpru";  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->SetFrom($from, 'TopCine EPN');
        $mail->addAddress($to, $to);
        $mail->isHTML(true);

        $mail->Subject    = $subject;
        $mail->MsgHTML($body);
        $mail->Send();
    }

?>
