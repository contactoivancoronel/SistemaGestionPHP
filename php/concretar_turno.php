<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    echo "Error: Usuario no autenticado.";
    exit();
}

// Establecer la conexión a la base de datos
$servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
$username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
$password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
$dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Obtener la fecha y hora actual
$fecha_hora_actual = date("Y-m-d H:i:s");

// Verificar si se ha proporcionado el ID del turno a concretar
if (isset($_POST['id_turno'])) {
    $id_turno = $_POST['id_turno'];

    // Consulta SQL para obtener el turno seleccionado
    $sql_turno = "SELECT fecha_hora_turno FROM turnos_seleccionados WHERE id_turno = $id_turno";
    $resultado_turno = $conexion->query($sql_turno);

    if ($resultado_turno->num_rows > 0) {
        $fila_turno = $resultado_turno->fetch_assoc();
        $fecha_hora_turno = $fila_turno['fecha_hora_turno'];

        // Insertar el turno concretado en la tabla turnos_concretados
        $sql_concretado = "INSERT INTO turnos_concretados (id_turno, fecha_hora_turno, fecha_hora_concretado) VALUES ($id_turno, '$fecha_hora_turno', '$fecha_hora_actual')";
        if ($conexion->query($sql_concretado) === TRUE) {
            echo "El turno con ID $id_turno se ha concretado correctamente.";

            // Eliminar el turno concretado de la tabla turnos_seleccionados
            $sql_eliminar = "DELETE FROM turnos_seleccionados WHERE id_turno = $id_turno";
            if ($conexion->query($sql_eliminar) === TRUE) {
                echo " El turno con ID $id_turno se ha eliminado de la tabla turnos_seleccionados.";
            } else {
                echo "Error al eliminar el turno con ID $id_turno de la tabla turnos_seleccionados: " . $conexion->error;
            }
        } else {
            echo "Error al concretar el turno con ID $id_turno: " . $conexion->error;
        }
    } else {
        echo "No se encontró el turno con ID $id_turno.";
    }
} else {
    echo "No se proporcionó el ID del turno a concretar.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

