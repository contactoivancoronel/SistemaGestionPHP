<?php
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

// Obtener el identificador del turno seleccionado desde el parámetro de la URL
if (isset($_GET['id'])) {
    $identificador = $_GET['id'];
    
    // Actualizar la disponibilidad del turno seleccionado en la base de datos
    $sql = "UPDATE sacar_turnos SET disponible = 0 WHERE id = '$identificador'";
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "El turno ha sido seleccionado correctamente.";
    } else {
        echo "Error al seleccionar el turno. Por favor, intenta nuevamente.";
    }
} else {
    echo "Identificador de turno no válido.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>