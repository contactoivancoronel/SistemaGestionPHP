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

// Consulta SQL para eliminar la cuenta del usuario
$sql_eliminar = "DELETE FROM usuario WHERE id = $id_usuario";

// Ejecutar la consulta
if ($conexion->query($sql_eliminar) === TRUE) {
    // Eliminación exitosa, cerrar la sesión y redirigir al usuario
    session_destroy();
    header('Location: cuenta_eliminada.php'); // Puedes crear una página de confirmación
    exit();
} else {
    // Manejar el caso en que no se pudo eliminar la cuenta
    echo "Error al eliminar la cuenta: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
