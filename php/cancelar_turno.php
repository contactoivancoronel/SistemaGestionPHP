<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    echo "Error: Usuario no autenticado.";
    exit();
}

// Verificar si se ha proporcionado el ID del turno a cancelar
if (!isset($_GET['id_turno'])) {
    echo "Error: ID de turno no especificado.";
    exit();
}

// Obtener el ID del turno a cancelar
$id_turno = $_GET['id_turno'];

// Establecer la conexión a la base de datos
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

// Consulta SQL para obtener la fecha y hora del turno a cancelar
$sql_turno = "SELECT fecha, hora FROM sacar_turnos WHERE id = '$id_turno'";
$resultado_turno = mysqli_query($conexion, $sql_turno);
$fila_turno = mysqli_fetch_assoc($resultado_turno);

// Obtener la fecha y hora actuales
$fecha_actual = date("Y-m-d");
$hora_actual = date("H:i:s");

// Calcular la diferencia entre la fecha/hora del turno y la fecha/hora actuales
$fecha_turno = $fila_turno['fecha'];
$hora_turno = $fila_turno['hora'];
$diff = strtotime($fecha_turno . " " . $hora_turno) - strtotime($fecha_actual . " " . $hora_actual);

// Verificar si faltan menos de 24 horas para el turno
if ($diff < 86400) {
    echo "Error: No se puede cancelar el turno con menos de 24 horas de antelación.";
    
    exit();
}

// Obtener el ID del usuario actual
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para eliminar el turno cancelado de la tabla turnos_seleccionados
$sql_eliminar = "DELETE FROM turnos_seleccionados WHERE id_turno = '$id_turno' AND id_usuario = '$id_usuario'";
$resultado_eliminar = mysqli_query($conexion, $sql_eliminar);

if ($resultado_eliminar) {
    echo "El turno ha sido cancelado correctamente.";
} else {
    echo "Error al cancelar el turno: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>