<?php
session_start(); // Inicializar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    echo "Error: Usuario no autenticado.";
    exit();
}

// Verificar si se ha pasado el ID del turno a eliminar por la URL
if (!isset($_GET['id_turno'])) {
    echo "Error: No se ha proporcionado un ID de turno válido.";
    exit();
}

$id_turno = $_GET['id_turno'];

// Realizar la eliminación del turno en la tabla sacar_turnos
$servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
$username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
$password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
$dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

// Obtener el ID de usuario
$id_usuario = $_SESSION['id_usuario'];

// Insertar el turno en la tabla turnos_seleccionados
$sql_insertar = "INSERT INTO turnos_seleccionados (id_usuario, id_turno) VALUES ('$id_usuario', '$id_turno')";
if (mysqli_query($conexion, $sql_insertar)) {
    // Eliminar el turno de la tabla sacar_turnos
    $sql_eliminar = "DELETE FROM sacar_turnos WHERE id = '$id_turno'";
    if (mysqli_query($conexion, $sql_eliminar)) {
        // Actualizar la lista de turnos seleccionados en la variable de sesión
        $_SESSION['turnos_seleccionados'][] = $id_turno;
        echo "Turno seleccionado y eliminado exitosamente.";
    } else {
        echo "Error al eliminar el turno de la tabla sacar_turnos: " . mysqli_error($conexion);
    }
} else {
    echo "Error al insertar el turno en la tabla turnos_seleccionados: " . mysqli_error($conexion);
}


// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
