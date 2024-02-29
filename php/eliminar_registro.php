<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
    header('Location: index.php');
    exit();
}

// Verificar si se recibió una solicitud POST para eliminar el registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
    // Establecer la conexión a la base de datos
    $servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
    $username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
    $password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
    $dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.
    
    $conexion = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar si la conexión fue exitosa
    if (mysqli_connect_errno()) {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
        exit();
    }

    // Obtener el ID del registro a eliminar
    $id_registro = mysqli_real_escape_string($conexion, $_POST['id_registro']);

    // Realizar la consulta para eliminar el registro
    $sql_eliminar = "DELETE FROM registros_ventas WHERE id_registro = '$id_registro'";
    $resultado_eliminar = mysqli_query($conexion, $sql_eliminar);

    // Verificar si la eliminación fue exitosa
    if ($resultado_eliminar) {
        echo "Registro eliminado correctamente.";
        header('Location: caja_admin.php');
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Si no se recibió una solicitud POST válida, redirigir a otra página (por ejemplo, index.php)
    header('Location: index.php');
    exit();
}
?>
