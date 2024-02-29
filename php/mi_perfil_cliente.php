<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'usuario') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
   header('Location: index.php');
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
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/registro1.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        h1 {
            text-align: center;
            margin: 10px 0;
        }

        .perfil-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        .perfil-container p {
            margin: 10px 0;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="submit"],
        input[type="button"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header class="head">
        <div class="logo">
            <a href="index.php"><img src="../imagenes/logo/logo.png" height="65px" width="65px"></a>
        </div>
        <nav class="navbar">
            <a href="home.php">Volver</a>
        </nav>
    </header>
    <br>
    <h1>Mi Perfil</h1>
    <br>
    <div class="perfil-container">
        <p>ID de Usuario: <?php echo $id_usuario; ?></p>
        <p>Rol: <?php echo $rol; ?></p>
        <p>Nombre de Usuario: <?php echo $nombre_usuario; ?></p>
        <p>Contraseña: ********</p>
        <p>Telefono: <?php echo $telefono; ?></p>
        <p>Email: <?php echo $email_usuario; ?></p>
    </div>

    <form action="editar_perfil_cliente.php" method="post">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <input type="submit" value="Editar Perfil">
    </form>
    <br>
    <form>
        <input type="button" value="Eliminar Cuenta" onclick="confirmarEliminacion()">
    </form>

    <script>
        function confirmarEliminacion() {
            var respuesta = confirm("¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.");
            if (respuesta) {
                // Si el usuario confirma, redirigir al script de eliminación de cuenta
                window.location.href = "eliminar_cuenta_cliente.php";
            }
        }
    </script>
</body>
</html>
