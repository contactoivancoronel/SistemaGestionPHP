<!DOCTYPE html>
<html lang="es">
<form action="../php/altasesion.php" method="post" class="form-altasesion"> 

                <br>
                <div class="botones-form">
                    <button type="submit" name="boton" class="boton1">Volver al inicio</button>

                </div>
        </form>
</html>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'flamencaalisados@flamencaalisados.website';
    $mail->Password = 'GimenaFlamenca@2023';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('flamencaalisados@flamencaalisados.website', 'FLAMENCA');
    $mail->addAddress('flamencaalisados@flamencaalisados.website', 'Receptor');
    //$mail->addCC('concopia@gmail.com');

    $mail->addAttachment('docs/dashboard.png', 'Dashboard.png');

    $mail->isHTML(true);
    $mail->Subject = 'Recupero de contraseña';
    $mail->Body = 'Hola, tu cliente ha solicitado un cambio de contraseña. Por favor revisa la base de datos para ver la nueva contraseña generada.';
    $mail->send();

    echo 'Correo enviado correctamente al Administrador.';
} catch (Exception $e) {
    echo 'Mensaje ' . $mail->ErrorInfo;
}

