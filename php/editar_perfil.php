<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    // Si no está autenticado, redirigir al usuario a otra página (por ejemplo, login.php)
    header('Location: altasesion.php');
    exit();
}

include('db.php'); // conexión con la base de datos

// Obtener el ID del usuario desde la sesión
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obtener todos los atributos del usuario
$sql = "SELECT id, rol, usuario, password, email, telefono FROM usuario WHERE id = $id_usuario";
$resultado = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if ($resultado->num_rows > 0) {
    // Obtener el resultado de la consulta
    $fila = $resultado->fetch_assoc();
    $id_usuario = $fila['id'];
    $rol = $fila['rol'];
    $nombre_usuario = $fila['usuario'];
    $password = $fila['password'];
    $telefono = $fila['telefono'];
    $email_usuario = $fila['email'];
} else {
    // Manejar el caso en que no se encuentre el usuario
    $id_usuario = "ID de usuario no encontrado";
    $rol = "Rol no encontrado";
    $nombre_usuario = "Nombre de usuario no encontrado";
    $password = "Contraseña no encontrada";
    $telefono = "Telefono no encontrado";
    $email_usuario = "Correo electrónico no encontrado";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/registro1.css">
</head>
<body>
<header class="head">
        <div class="logo">
            <a href="index.php"><img src="../imagenes/logo/logo.png" height="65px" width="65px"></a>
        </div>
        <nav class="navbar">
            <a href="mi_perfil.php">Volver</a>
        </nav>
    </header>
    <h1>Editar Perfil</h1>
    <br>
    <form action="guardar_cambios.php" method="post">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <label for="nombre_usuario">Nuevo Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>" required>
        <br>
        <br>

        <label for="nueva_password">Nueva Contraseña:</label>
        <input type="password" id="nueva_password" name="nueva_password" required>
        <br>
        <br>

        <label for="confirmar_nueva_password">Confirmar Nueva Contraseña:</label>
        <input type="password" id="confirmar_nueva_password" name="confirmar_nueva_password" required>
        <br>
        <br>

        <label for="nuevo_telefono">Nuevo Número de Teléfono:</label>
        <input type="tel" id="nuevo_telefono" name="nuevo_telefono" value="<?php echo $telefono; ?>" required>
        <br>
        <br>


        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
