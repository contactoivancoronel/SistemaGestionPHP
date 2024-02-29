<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Servicio</title>
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
            <a href="servAdmin.php">Volver</a>
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

    // Verificar si se envió el formulario de editar servicio
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'editar') {
        $id_servicio = $_POST['id_servicio'];

        // Consulta SQL para obtener los datos del servicio seleccionado
        $sql_obtener_servicio = "SELECT * FROM servicios WHERE id = '$id_servicio'";
        $result_servicio = mysqli_query($conexion, $sql_obtener_servicio);

        if ($result_servicio && mysqli_num_rows($result_servicio) > 0) {
            $row_servicio = mysqli_fetch_assoc($result_servicio);

            // Mostrar el formulario para editar los atributos del servicio
            ?>
            <h1>Editar Servicio</h1>
            <form action="actualizar_servicio.php" method="post">
                <input type="hidden" name="id_servicio" value="<?php echo $row_servicio['id']; ?>">
                <label for="nombreServ">Servicio:</label>
                <input type="text" id="nombreServ" name="nombreServ" value="<?php echo $row_servicio['servicio']; ?>" required><br><br>

                <label for="descripServ">Descripcion:</label>
                <input type="text" id="descripServ" name="descripServ" value="<?php echo $row_servicio['descripcion']; ?>" required><br><br>

                <label for="precioServ">Precio:</label>
                <input type="number" id="precioServ" name="precioServ" value="<?php echo $row_servicio['precio']; ?>" required min="1"><br>

                <br>

                <input type="submit" value="Actualizar Servicio">
            </form>
        <?php
        } else {
            echo "Error al obtener los datos del servicio.";
        }
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
    ?>

</body>
</html>
