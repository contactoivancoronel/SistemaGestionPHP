<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
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
        input[type="email"] {
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
            <a href="index.php"><img src="../imagenes/logo/logo.png" height="65px" width="65px"></a>
        </div>
        <nav class="navbar">
            <a href="agregar_empleado.php">Volver</a>
        </nav>
    </header>

    <?php
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

    // Verificar si se envió el formulario de editar empleado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'editar') {
        $id_empleado = $_POST['id_empleado'];

        // Consulta SQL para obtener los datos del empleado seleccionado
        $sql_obtener_empleado = "SELECT * FROM empleados WHERE id = '$id_empleado'";
        $result_empleado = mysqli_query($conexion, $sql_obtener_empleado);

        if ($result_empleado && mysqli_num_rows($result_empleado) > 0) {
            $row_empleado = mysqli_fetch_assoc($result_empleado);

            // Mostrar el formulario para editar los atributos del empleado
    ?>
            <h1>Editar Empleado</h1>
            <form action="actualizar_empleado.php" method="post">
                <input type="hidden" name="id_empleado" value="<?php echo $row_empleado['id']; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $row_empleado['nombre']; ?>" required><br><br>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $row_empleado['apellido']; ?>" required><br><br>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $row_empleado['telefono']; ?>" required><br><br>

                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo $row_empleado['correo']; ?>" required><br>
                <br>

                <input type="submit" value="Actualizar Empleado">
            </form>
    <?php
        } else {
            echo "Error al obtener los datos del empleado.";
        }
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
    ?>

</body>

</html>
