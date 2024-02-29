<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;        //SMTP:: DEBUG_OFF             //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'heladeriaunlz@gmail.com';                     //SMTP username
    $mail->Password   = 'heladeria12345';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('heladeriaunlz@gmail.com', 'FLAMENCA ALISADOS');
    $mail->addAddress('contactoivancoronel@gmail.com', 'Joe User');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('heladeriaunlz@gmail.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    /*/Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name */

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recupere Contraseña';

    $cuerpo = '<h4>Gracias por confiar en flamenca!</h4>';

    $mail->Body    = utf8_decode($cuerpo);
    $mail->AltBody = 'Le enviamos su password.';

    $mail-> setLanguage('es','../phpmailer/language/phpmailer.lang-es.php');

    $mail->send();
   // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Error al enviar el correo electronico del recupero: {$mail->ErrorInfo}";
}