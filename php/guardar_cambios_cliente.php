<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    // Si no está autenticado, redirigir al usuario a otra página (por ejemplo, login.php)
    header('Location: altasesion.php');
    exit();
}

include('db.php'); // conexión con la base de datos

// Obtener los datos del formulario
$id_usuario = $_POST['id_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$nueva_password = $_POST['nueva_password'];
$confirmar_nueva_password = $_POST['confirmar_nueva_password']; // Nuevo campo para confirmar la contraseña
$nuevo_telefono = $_POST['nuevo_telefono'];

// Verificar que las contraseñas coincidan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($nueva_password == $confirmar_nueva_password) {
        // Las contraseñas coinciden, puedes proceder con la actualización en la base de datos
        $sql = "UPDATE usuario SET usuario = '$nombre_usuario', password = '$nueva_password', telefono = '$nuevo_telefono' WHERE id = $id_usuario";

        if ($conexion->query($sql) === TRUE) {
            session_destroy();
            header('Location: altasesion.php');
            exit();
        } else {
            // Manejar el caso en que ocurra un error al guardar cambios
            echo "Error al guardar cambios: " . $conexion->error;
        }
    } else {
        // Las contraseñas no coinciden, puedes mostrar un mensaje de error
        echo "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
