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

// Procesar el formulario y realizar la inserción en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);

    // Consulta SQL para insertar el registro en la tabla registros_gastos
    $sql_insert_gasto = "INSERT INTO registros_gastos (nombre, descripcion, precio, cantidad) VALUES ('$nombre', '$descripcion', $precio, $cantidad)";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql_insert_gasto)) {
        echo "Gasto registrado correctamente.";
        header("Location: {$_SERVER['PHP_SELF']}");
    } else {
        echo "Error al registrar el gasto: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Gasto</title>
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

        input[type="text"],
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
            <a href="caja_admin.php">Volver</a>
        </nav>
    </header>

    <h2>Registro de Gastos</h2>
    <form action="procesar_registro_gasto.php" method="post">
        <label for="nombre">Nombre del Gasto:</label>
        <input type="text" name="nombre" required><br>
        <br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" rows="3" required></textarea><br><br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required><br>

        <input type="submit" value="Registrar gasto">
    </form>
</div>

</body>
</html>
