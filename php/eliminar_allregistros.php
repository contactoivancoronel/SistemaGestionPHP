<?php
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['tipo']) && ($_GET['tipo'] == 'ventas' || $_GET['tipo'] == 'gastos')) {
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

    // Tipo de tabla (ventas o gastos)
    $tipo = $_GET['tipo'];

    // Borrar todos los registros de la tabla especificada
    $sql_borrar = "DELETE FROM registros_" . $tipo;
    mysqli_query($conexion, $sql_borrar);

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    header('Location:caja_admin.php'); // Redirigir a la página actual después de borrar
    exit();
} else {
    header('Location:caja_admin.php'); // Redirigir a la página actual si no se especifica el tipo correctamente
    exit();
}
?>
