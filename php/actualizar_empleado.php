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

// Verificar si se envió el formulario de actualizar empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_empleado'])) {
    $id_empleado = $_POST['id_empleado'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Consulta SQL para actualizar los atributos del empleado
    $sql_actualizar = "UPDATE empleados SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', correo = '$correo' WHERE id = '$id_empleado'";

    if (mysqli_query($conexion, $sql_actualizar)) {
        echo '<script>alert("Empleado actualizado correctamente");</script>';
        header("Location: agregar_empleado.php"); // Puedes redirigir a la página que desees
    } else {
        echo "Error al actualizar el empleado: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
