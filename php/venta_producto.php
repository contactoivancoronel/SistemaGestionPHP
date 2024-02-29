<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de Producto</title>
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/registro1.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        h1 {
            text-align: center;
            margin: 10px 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header class="head">
        <div class="logo">
            <a href="#"><img src="../imagenes/logo/logo.png" height="65px" width="65px"></a>
        </div>
        <nav class="navbar">
            <a href="prodAdmin.php">Volver</a>
        </nav>
    </header>

    <?php
    // Obtener el ID del producto de la solicitud POST
    if (isset($_POST['id_producto'])) {
        $id_producto = $_POST['id_producto'];

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

        // Consulta SQL para obtener la información del producto
        $sql_producto = "SELECT * FROM productos WHERE id = '$id_producto'";
        $result_producto = mysqli_query($conexion, $sql_producto);

        if ($result_producto && mysqli_num_rows($result_producto) > 0) {
            $row_producto = mysqli_fetch_assoc($result_producto);

            // Mostrar información del producto
            echo "<h1>Venta de Producto</h1>";
            echo "<p>ID: " . $row_producto['id'] . "</p>";
            echo "<p>Nombre: " . $row_producto['nombre'] . "</p>";
            echo "<p>Stock: " . $row_producto['stock'] . "</p>";
            echo "<p>Precio: $" . $row_producto['precio'] . "</p>";
            echo "<p>Precio de Reventa: $" . $row_producto['precio_reventa'] . "</p>";

            // Mostrar formulario para la venta
    ?>
            <form action="procesar_venta.php" method="post">
                <input type="hidden" name="id_producto" value="<?php echo $row_producto['id']; ?>">
                <label for="cantidad">Cantidad de unidades vendidas:</label>
                <input type="number" id="cantidad" name="cantidad" required min="1" max="<?php echo $row_producto['stock']; ?>">
                <br>
                <br>
                <input type="submit" value="Registrar Venta">
            </form>
    <?php
        } else {
            echo "Error al obtener la información del producto.";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "ID de producto no proporcionado.";
    }
    ?>

</body>

</html>
