<?php
// Establecer la conexión a la base de datos
$servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
$username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
$password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
$dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Consulta para eliminar todos los registros de la tabla 'turnos_seleccionados'
$sql_eliminar_registros = "DELETE FROM turnos_seleccionados";

if ($conexion->query($sql_eliminar_registros) === TRUE) {
    echo "Registros eliminados exitosamente.";
    header("Location: {$_SERVER['PHP_SELF']}");
} else {
    echo "Error al eliminar registros: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
