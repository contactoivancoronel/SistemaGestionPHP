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

// Verificar si se envió el formulario de actualizar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Consulta SQL para actualizar los atributos del producto
    $sql_actualizar_producto = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', stock = '$stock' WHERE id = '$id_producto'";

    if (mysqli_query($conexion, $sql_actualizar_producto)) {
        echo '<script>alert("Producto actualizado correctamente");</script>';
        header("Location: prodAdmin.php"); // Puedes redirigir a la página que desees
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
