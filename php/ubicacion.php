<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Ubicacion</title>
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/registro1.css">
    <style>
        .error {
            color: red;
            font-weight: bold;
        }

        section {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        section h2 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .ubicacion-actual {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .ubicacion-actual h2 {
            margin-bottom: 10px;
        }

        .ubicacion-actual p {
            font-size: 18px;
            color: #333;
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

    <section>
        <h2>Actualización de Ubicación</h2>
        <form action="ubicacionform.php" method="post">
            <label for="nueva_ubicacion">Nueva Ubicación:</label>
            <input type="text" id="nueva_ubicacion" name="nueva_ubicacion" required>
            <button type="submit">Actualizar Ubicación</button>
        </form>
    </section>

    <!-- Muestra la ubicación actual -->
    <div class="ubicacion-actual">
        <h2>Ubicación Actual</h2>
        <?php
        $servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
        $username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
        $password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
        $dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.
        
        $conexion = mysqli_connect($servername, $username, $password, $dbname);

        if (mysqli_connect_errno()) {
            echo "Error en la conexión a la base de datos 'validar': " . mysqli_connect_error();
            exit;
        }

        session_start();

        if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
            header('Location: index.php');
            exit();
        }

        $sql_validar = "SELECT ubicacion FROM ubicacion WHERE id = 1";
        $resultado_validar = mysqli_query($conexion_validar, $sql_validar);

        if ($resultado_validar) {
            $fila = mysqli_fetch_assoc($resultado_validar);

            if ($fila !== null) {
                $ubicacion_actual = $fila['ubicacion'];
                echo "<p>$ubicacion_actual</p>";
            } else {
                echo "No se encontraron resultados para la consulta.";
            }
        } else {
            echo "Error al obtener la ubicación actual: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
        ?>
    </div>

</body>

</html>
