<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
    header('Location: index.php');
    exit();
}

if (isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad_vendida = $_POST['cantidad'];

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

    // Obtener información actual del producto
    $sql_producto = "SELECT * FROM productos WHERE id = '$id_producto'";
    $result_producto = mysqli_query($conexion, $sql_producto);

    if ($result_producto && mysqli_num_rows($result_producto) > 0) {
        $row_producto = mysqli_fetch_assoc($result_producto);
        $stock_actual = $row_producto['stock'];
        $precio = $row_producto['precio'];
        $precio_reventa = $row_producto['precio_reventa'];

        // Verificar si hay suficiente stock para realizar la venta
        if ($cantidad_vendida <= $stock_actual) {
            // Calcular nuevo stock
            $nuevo_stock = $stock_actual - $cantidad_vendida;

            // Calcular ganancias totales
            $ganancias = $cantidad_vendida * ($precio_reventa - $precio);

            // Actualizar el stock, la cantidad vendida y las ganancias en la base de datos
            $sql_actualizar_stock = "UPDATE productos SET stock = '$nuevo_stock', cantidad_vendida = cantidad_vendida + '$cantidad_vendida', ganancias_totales = ganancias_totales + '$ganancias' WHERE id = '$id_producto'";
            $result_actualizar_stock = mysqli_query($conexion, $sql_actualizar_stock);

            if ($result_actualizar_stock) {
                // Registrar la venta en la tabla registros_ventas
                $sql_insert_venta = "INSERT INTO registros_ventas (id_producto, nombre_producto, precio_producto, precio_reventa, cantidad_vendida, ganancias_totales) VALUES ('$id_producto', '{$row_producto['nombre']}', '$precio', '$precio_reventa', '$cantidad_vendida', '$ganancias')";
                $result_insert_venta = mysqli_query($conexion, $sql_insert_venta);

                if ($result_insert_venta) {
                    echo "Venta registrada exitosamente. Nuevo stock: $nuevo_stock, Cantidad vendida: $cantidad_vendida, Ganancias: $ganancias";
                } else {
                    echo "Error al registrar la venta en la tabla registros_ventas: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al actualizar el stock, la cantidad vendida y las ganancias en la base de datos: " . mysqli_error($conexion);
            }
        } else {
            echo "Error: La cantidad vendida es mayor que el stock disponible.";
        }
    } else {
        echo "Error al obtener la información del producto.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir a prodAdmin.php después de completar la venta
    header('Location: prodAdmin.php');
    exit();
} else {
    echo "Error: Datos de venta no proporcionados.";
}
?>
