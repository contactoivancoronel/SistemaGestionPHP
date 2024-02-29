
<?php
session_start();

if (isset($_GET['id_turno'])) {
    // Obtener el ID del turno a eliminar
    $id_turno = $_GET['id_turno'];


    $servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
    $username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
    $password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
    $dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.
    
    $conexion = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM turnos_seleccionados WHERE id_turno = $id_turno";

    if (mysqli_query($conexion, $sql)) {
        echo "Turno eliminado correctamente";
    } else {
        echo "Error al eliminar el turno: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    echo "ID de turno no proporcionado";
}
?>
