<?php
// Verificar si se envió el ID del producto a eliminar
if (isset($_GET['id'])) {
    // Obtener el ID del producto a eliminar
    $id_producto = $_GET['id'];

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

    // Consulta SQL para eliminar el producto
    $sql_eliminar = "DELETE FROM productos WHERE id = '$id_producto'";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql_eliminar)) {
        echo "Producto eliminado exitosamente.";
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "ID de producto no proporcionado. Por favor, asegúrate de proporcionar el ID del producto a eliminar.";
}
?>