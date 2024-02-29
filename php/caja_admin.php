<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
    header('Location: index.php');
    exit();
}

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

// Consultar los registros de ventas
$sql_ventas = "SELECT * FROM registros_ventas";
$result_ventas = mysqli_query($conexion, $sql_ventas);

// Calcular el total absoluto de ganancias
// Consultar los registros de gastos
$sql_gastos = "SELECT * FROM registros_gastos";
$result_gastos = mysqli_query($conexion, $sql_gastos);

// Calcular el total absoluto de gastos
$total_absoluto_gastos = 0;
$cantidad_ventas = mysqli_num_rows($result_ventas); // Obtener la cantidad de ventas


// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caja del Administrador</title>
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/registro1.css">
    <style>
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
            <a href="indexAdmin.php">Volver</a>
        </nav>
    </header>

    <table>
        <h2>Venta de Productos</h2>
        <thead>
            <tr>
                <th>ID Registro</th>
                <th>ID Producto</th>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Precio Reventa</th>
                <th>Cantidad Vendida</th>
                <th>Ganancia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <?php
        $total_absoluto = 0; // Inicializar la variable antes del bucle
        $cantidad_ventas = mysqli_num_rows($result_ventas); // Obtener la cantidad de ventas

        if ($result_ventas && $cantidad_ventas > 0) {
            while ($row_venta = mysqli_fetch_assoc($result_ventas)) {
                echo "<tr>";
                echo "<td>{$row_venta['id_registro']}</td>";
                echo "<td>{$row_venta['id_producto']}</td>";
                echo "<td>{$row_venta['nombre_producto']}</td>";
                echo "<td>{$row_venta['precio_producto']}</td>";
                echo "<td>{$row_venta['precio_reventa']}</td>";
                echo "<td>{$row_venta['cantidad_vendida']}</td>";
                echo "<td>{$row_venta['ganancias_totales']}</td>";
                echo "<td>
                            <form action='eliminar_registro.php' method='post'>
                                <input type='hidden' name='accion' value='eliminar'>
                                <input type='hidden' name='id_registro' value='" . $row_venta['id_registro'] . "'>
                                <input type='submit' value='Eliminar Venta'>
                            </form>
                        </td>";
                echo "</tr>";

                // Actualizar el total absoluto
                $total_absoluto += $row_venta['ganancias_totales'];
            }
            // Agregar la fila del total absoluto y la cantidad de ventas
            echo "<tr>";
            echo "<td colspan='6'><b>Total Absoluto de Ganancias</b></td>";
            echo "<td>{$total_absoluto}</td>";
            echo "<td><b>{$cantidad_ventas} ventas</b></td>";
            echo "</tr>";

        } else {
            echo "<tr><td colspan='7'>No hay registros de ventas.</td></tr>";
        }
        ?>
    </table>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        tbody td {
            color: #333;
        }

        td:nth-child(odd) {
            background-color: #f9f9f9;
        }

        caption {
            caption-side: top;
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
        }

        button {
            display: block;
            margin: 20px auto; /* Centrar el botón horizontalmente con un margen */
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>  
    
    <h2>Gastos</h2>

    <button onclick="window.location.href='procesar_registro_gasto.php'">Registrar Gasto</button>
    
</form>

<table>
        <thead>
            <tr>
                <th>ID Registro</th>
                <th>Nombre del Gasto</th>
                <th>Descripcion</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Gasto Total</th>
                <th>Acciones</th>
                <th></th>
            </tr>
        </thead>
        <?php
        $total_absoluto_gastos = 0; // Inicializar la variable antes del bucle
        $cantidad_gastos = mysqli_num_rows($result_gastos); // Obtener la cantidad de registros de gastos

        if ($result_gastos && $cantidad_gastos > 0) {
            while ($row_gasto = mysqli_fetch_assoc($result_gastos)) {
                echo "<tr>";
                echo "<td>{$row_gasto['id_gasto']}</td>";
                echo "<td>{$row_gasto['nombre']}</td>";
                echo "<td>{$row_gasto['descripcion']}</td>";
                echo "<td>{$row_gasto['precio']}</td>";
                echo "<td>{$row_gasto['cantidad']}</td>";

                // Calcular y mostrar el gasto total por cada registro
                $gasto_total = $row_gasto['precio'] * $row_gasto['cantidad'];
                echo "<td>{$gasto_total}</td>";
                echo "<td>
                        <form action='eliminar_registro_gasto.php' method='post'>
                            <input type='hidden' name='accion' value='eliminar'>
                            <input type='hidden' name='id_gasto' value='" . $row_gasto['id_gasto'] . "'>
                            <input type='submit' value='Eliminar Gasto'>
                        </form>
                    </td>";
                echo "</tr>";

                // Actualizar el total absoluto de gastos
                $total_absoluto_gastos += $gasto_total;
            }
            // Agregar la fila del total absoluto de gastos y la cantidad de gastos
            echo "<tr>";
            echo "<td colspan='4'><b>Total Absoluto de Gastos</b></td>";
            echo "<td></td>";
            echo "<td>{$total_absoluto_gastos}</td>";
            echo "<td><b>{$cantidad_gastos} gastos</b></td>";
            echo "</tr>";

        } else {
            echo "<tr><td colspan='7'>No hay registros de gastos.</td></tr>";
        }
        ?>
    </table>

    <table>
        <h2>Balance Total</h2>
        <thead>
            <tr>
                <th>Balance Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tr>
            <td><?php echo ($total_absoluto - $total_absoluto_gastos); ?></td>
            <td>
                <?php
                $balance = $total_absoluto - $total_absoluto_gastos;
                echo ($balance < 0) ? "Pérdida" : "Ganancia";
                ?>
            </td>
        </tr>
    </table>
</body>
</html>
