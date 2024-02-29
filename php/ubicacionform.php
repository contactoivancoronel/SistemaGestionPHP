<?php
$servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
$username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
$password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
$dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

$conexion = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos 'validar': " . mysqli_connect_error();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe la nueva ubicación desde el formulario
    $nueva_ubicacion = $_POST["nueva_ubicacion"];

    // TODO: Realiza las validaciones necesarias en la nueva ubicación si es necesario.

    // Ejemplo: Actualiza la ubicación en la base de datos (supongamos que usas MySQL)
    $query = "UPDATE ubicacion SET ubicacion = '$nueva_ubicacion' WHERE id = 1"; // Supongamos que la ubicación está en una tabla llamada 'validar' con una columna 'ubicacion'
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        // Maneja el caso de error
        echo "Error al actualizar la ubicación: " . mysqli_error($conexion);
    }else {
        // Redirige a ubicacion.php después de la actualización
        header("Location: ubicacion.php");
        exit;
    }
}

// Cerrar la conexión a la base de datos "validar"
mysqli_close($conexion);
?>
