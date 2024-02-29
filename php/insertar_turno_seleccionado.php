<?php
session_start(); // Inicializar la sesión

?>
<?php
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

// Obtener los parámetros del ID de usuario y el ID del turno
$id_usuario = $_GET['id_usuario'];
$id_turno = $_GET['id_turno'];

// Función para insertar un turno seleccionado en la tabla turnos_seleccionados
function insertarTurnoSeleccionado($conexion, $id_usuario, $id_turno) {
    // Insertar el turno en la tabla turnos_seleccionados
    $sql_insertar = "INSERT INTO turnos_seleccionados (id_usuario, id_turno) VALUES ('$id_usuario', '$id_turno')";
    if (mysqli_query($conexion, $sql_insertar)) {
        // Actualizar la disponibilidad del turno en la tabla sacar_turnos
        $sql_actualizar = "UPDATE sacar_turnos SET disponible = 0 WHERE id = '$id_turno'";
        if (mysqli_query($conexion, $sql_actualizar)) {
            echo "El turno se seleccionó correctamente.";
        } else {
            echo "Error al actualizar la disponibilidad del turno: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al seleccionar el turno: " . mysqli_error($conexion);
    }
}

// Llamar a la función para insertar el turno seleccionado
insertarTurnoSeleccionado($conexion, $id_usuario, $id_turno);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>