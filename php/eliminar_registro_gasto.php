<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
    header('Location: index.php');
    exit();
}

// Verificar si se ha enviado el formulario y si contiene la información necesaria
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['id_gasto'])) {
    // Obtener los datos del formulario
    $id_gasto = $_POST['id_gasto'];

    // Realizar las verificaciones necesarias (puedes agregar más según tus requisitos)

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

    // Realizar la eliminación del registro de gasto
    $sql_eliminar = "DELETE FROM registros_gastos WHERE id_gasto = $id_gasto";

    if (mysqli_query($conexion, $sql_eliminar)) {
        echo "Registro de gasto eliminado correctamente.";
        header('Location: caja_admin.php');
    } else {
        echo "Error al eliminar el registro de gasto: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Si no se cumple alguna de las condiciones, redirigir al usuario a otra página o mostrar un mensaje de error
    echo "Error: Acceso no permitido.";
}
?>
