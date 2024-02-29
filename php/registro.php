<?php
session_start();
include('db.php'); // conexión con la base de datos

// Inicializar las variables de error
$usuarioError = $contrasenaError = $emailError = $telefonoError = $confirmarContrasenaError = '';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario de registro
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $rol = "usuario"; // Asigna el valor del rol correspondiente, en este caso "usuario"

    // Verificar si los campos están vacíos
    if (empty($usuario) || empty($contrasena) || empty($email) || empty($telefono)) {
        echo '<p class="error">Por favor, completa todos los campos.</p>';
    } else {
        // Validar la contraseña
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $contrasena)) {
            $contrasenaError = "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número.";
        }

        // Verificar si el usuario ya existe
        $sql = "SELECT * FROM usuario WHERE usuario='$usuario' OR email='$email'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            // El usuario o el correo electrónico ya existen, mostrar mensajes de error correspondientes
            $row = mysqli_fetch_assoc($resultado);
            if ($row['usuario'] === $usuario) {
                $usuarioError = "El nombre de usuario ya está registrado.";
            }
            if ($row['email'] === $email) {
                $emailError = "El correo electrónico ya está registrado.";
            }
        } else {
            // Insertar los datos en la tabla de usuario
            $sql = "INSERT INTO usuario (usuario, password, email, telefono, rol) VALUES ('$usuario', '$contrasena', '$email', '$telefono', '$rol')";
            if (mysqli_query($conexion, $sql)) {
                // Los datos se guardaron correctamente, redirigir al usuario a otra página
                header('Location: altasesion.php');
                exit();
            } else {
                // Hubo un error al guardar los datos, mostrar un mensaje de error
                echo '<p class="error">Error al guardar los datos: ' . mysqli_error($conexion) . '</p>';
            }
        }
    }
}

mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/registro1.css">
    <style>
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <header class="head">

        <div class="logo">
            <a href="index.php"><img src="../imagenes/logo/logo.png" heigth="65px" width="65px"></a>
        </div>

        <nav class="navbar">
            <a href="altasesion.php">Volver</a>
        </nav>

    </header>

    <section>
        <br>
        <br>

        <form action="registro.php" method="post" class="form-registro">

            <h1>Registro de usuarios</h1>

            <p>Nombre de usuario <input type="text" placeholder="Ingrese su nombre de usuario" name="usuario" required> </p>
            <?php if (!empty($usuarioError)) : ?>
                <p class="error"><?php echo $usuarioError; ?></p>
            <?php endif; ?>

            <p>Contraseña <input type="password" placeholder="Ingrese su contraseña" name="password" required> </p>
            <p>Confirmar Contraseña <input type="password" placeholder="Confirme su contraseña" name="confirmar_password" required> </p>
            <?php if (!empty($contrasenaError)) : ?>
                <p class="error"><?php echo $contrasenaError; ?></p>
            <?php endif; ?>

            <p>Email <input type="text" placeholder="Ingrese su email" name="email" required> </p>
            <?php if (!empty($emailError)) : ?>
                <p class="error"><?php echo $emailError; ?></p>
            <?php endif; ?>

            <p>Número de teléfono <input type="text" placeholder="Ingrese su teléfono" name="telefono" required> </p>

            <br>

            <div class="botones-form">
                <button class="boton1" type="submit" name="aceptar">Aceptar</button>
                <a class="boton1" href="altasesion.php">Cancelar </a>
            </div>

        </form>

    </section>

</body>

</html>
