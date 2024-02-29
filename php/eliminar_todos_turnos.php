<?php
$servername = "localhost";
$username = "u869947011_flamenca";
$password = "GimenaFlamenca@2023";
$dbname = "u869947011_bdhostinger";

$conexion = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit;
}

// Consulta SQL para eliminar todos los turnos permanentemente
$sql = "DELETE FROM sacar_turnos";

if (mysqli_query($conexion, $sql)) {
    echo "Todos los turnos han sido eliminados permanentemente.";
    // Redirigir a la página principal o a donde consideres apropiado
    header("Location: indexAdmin.php");
} else {
    echo "Error al eliminar todos los turnos: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
