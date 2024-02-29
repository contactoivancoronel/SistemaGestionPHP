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

// Verificar si se envió el formulario de actualizar servicio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_servicio'])) {
    $id_servicio = $_POST['id_servicio'];
    $nombreServ = $_POST['nombreServ'];
    $descripServ = $_POST['descripServ'];

    // Consulta SQL para actualizar los atributos del servicio
    $sql_actualizar_servicio = "UPDATE servicios SET servicio = '$nombreServ', precio = '$descripServ' WHERE id = '$id_servicio'";

    if (mysqli_query($conexion, $sql_actualizar_servicio)) {
        echo '<script>alert("Servicio actualizado correctamente");</script>';
        header("Location: servAdmin.php"); 
        echo "Error al actualizar el servicio: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
