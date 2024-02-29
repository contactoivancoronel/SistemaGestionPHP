<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/recupera.css">

    <title>Recupero de contraseña</title>

        <header class="head">
            <div class="logo">
                <a href="index.php"><img src="../imagenes/logo/logo.png" heigth="65px" width="65px"></a>
            </div>
            <nav class="navbar">
                <a href="altasesion.php">Volver</a>
            </nav>
        </header>

    <main class="form-login">
        <h3>Recuperar Contraseña</h3>
            <form action="recupera.php" method="post" class="row g-2 " autocomplete="off">
                <div class="form-floating">
                    <input class="form-control" type="email" name="usuario" id="email" placeholder="Ingrese su correo electronico"
                        required>
                </div>

                <div class="botones-form">
                    <button type="submit" name="boton" class="boton1">Continuar</button>
                </div>

                <div class="botones-form">
                    ¿No tiene cuenta?<a href="registro.php">Registrate Aqui</a>
                </div>
    </main>

</html>
<?php

$servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
$username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
$password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
$dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['usuario'])) {
        $email = $_POST['usuario'];

        // Verificar si el correo electrónico existe en la base de datos
        $query = "SELECT * FROM usuario WHERE email = '$email'";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Generar una nueva contraseña aleatoria
            $nuevaContrasena = generarContrasenaAleatoria();

            // Actualizar la contraseña en la base de datos
            $query = "UPDATE usuario SET password = '$nuevaContrasena' WHERE email = '$email'";
            mysqli_query($conexion, $query);

            // Enviar la nueva contraseña por correo electrónico al usuario
            enviarCorreoRecuperacion($email, $nuevaContrasena);

            // Redirigir al usuario a una página de éxito
            header('Location: nuevo.php');
            exit();
        } else {
            echo '<script>alert("El correo electronico no existe!.");</script>';
           // header('Location: recupera.php');
            exit();
        }
    }
}

function generarContrasenaAleatoria() {
    $longitud = 8; // Longitud de la contraseña generada
    $caracteresPermitidos = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; // Caracteres permitidos para la contraseña
    $contrasena = '';

    // Generar la contraseña aleatoria
    for ($i = 0; $i < $longitud; $i++) {
        $indice = mt_rand(0, strlen($caracteresPermitidos) - 1);
        $caracter = $caracteresPermitidos[$indice];
        $contrasena .= $caracter;
    }

    return $contrasena;
}

function enviarCorreoRecuperacion($email, $nuevaContrasena) {
    require '/xampp/htdocs/flamenca/email/vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'flamencaalisados@gmail.com';
        $mail->Password = 'GimenaFlamenca@2023';
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('flamencaalisados@gmail.com', 'FLAMENCA ALISADOS');
        $mail->addAddress($email); // Correo del usuario
        //$mail->addCC('concopia@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = ' Recuperación de Contraseña - Cuenta FlamencaAlisados';
        $mail->Body = 'Estimado cliente/a. Recibimos su solictud de cambio de contraseña. Su nueva contraseña es: ' . $nuevaContrasena;
        $mail->send();

        Location:('nuevo.php');
        
    } catch (Exception $e) {
        echo 'Mensaje ' . $mail->ErrorInfo;
    }
}
?>


