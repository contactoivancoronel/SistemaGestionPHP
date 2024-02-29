<?php
session_start();
include('db.php'); // conexión con la base de datos

// Obtener los datos del formulario de registro
$usuario = $_POST['usuario'];
$contrasena = $_POST['password'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];

// Verificar si el usuario ya existe
$sql = "SELECT * FROM usuario WHERE usuario='$usuario' OR email='$email'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    // El usuario ya existe, mostrar un mensaje de error
    echo "El usuario ya está registrado.";
} else {
    // Generar un código de invitación único
    $codigo = generarCodigoInvitacion();

    // Insertar los datos en la tabla de usuarios
    $sql = "INSERT INTO usuario (usuario, password, email, telefono, rol) VALUES ('$usuario', '$contrasena', '$email', '$telefono', 'usuario')";
    if (mysqli_query($conexion, $sql)) {
        // Los datos se guardaron correctamente, insertar la invitación en la tabla de invitaciones
        $sql = "INSERT INTO invitaciones (codigo, estado) VALUES ('$codigo', 'pendiente')";
        if (mysqli_query($conexion, $sql)) {
            // Invitación generada correctamente, redirigir al usuario a otra página
            header('Location: registro_completo.php');
        } else {
            // Hubo un error al guardar la invitación, mostrar un mensaje de error
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        // Hubo un error al guardar los datos del usuario, mostrar un mensaje de error
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

mysqli_close($conexion);

// Función para generar un código de invitación único
function generarCodigoInvitacion() {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';
    for ($i = 0; $i < 10; $i++) {
        $indice = rand(0, strlen($caracteres) - 1);
        $codigo .= $caracteres[$indice];
    }
    return $codigo;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar</title>
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
</head>

<body>

<header class="head">
    
    <div class="logo">
    <a href="index.php"><img src="../imagenes/logo/logo.png" height="65px" width="65px"></a>
    </div>  

    <nav class="navbar">
            <a href="index.php">Inicio</a>
            <a href="nosotros.php">Nosotros</a>
            <a href="#">Contacto</a>
            <a href="servicios.php">Servicios</a>
            <a href="productos.php">Productos</a>
            <a href="login.php">Iniciar Sesión</a>
    </nav> 

</header>
  
<section class="section-login">
    
    <div class="container-login">
        <div class="box-login">
            <div class="titulo">
                Registro de usuarios
            </div>
            
            <form class="formulario" action="registrar.php" method="POST">
                <div class="campo">
                    <label for="usuario">Nombre de usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Ingrese su nombre de usuario" required>
                </div>
                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Ingrese su contraseña" required>
                </div>
                <div class="campo">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Ingrese su email" required>
                </div>
                <div class="campo">
                    <label for="telefono">Numero de telefono</label>
                    <input type="tel" name="telefono" id="telefono" placeholder="Ingrese su telefono" required>
                </div>
                <div class="botones">
                    <input class="boton-aceptar" type="submit" value="Aceptar">
                    <input class="boton-cancelar" type="reset" value="Cancelar">
                </div>
            </form>
        </div>
    </div>
</section>

</body>
</html>
