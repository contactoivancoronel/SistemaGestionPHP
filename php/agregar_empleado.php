<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/turnos_admin.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #f5f5f5;
            background-image: linear-gradient(to bottom right, #c39bd3, #f9f0ff);
            color: #333;
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

        .titulos {
            text-align: center;
            margin: 10px 0;
        }

        .container_empleados {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .tabla_empleados {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            text-align: left;
            padding: 15px;
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

        #buscador {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
    </style>
    <title>Empleados</title>
</head>
<body>
<header class="head">
    <div class="logo">
        <a href="#"><img src="../imagenes/logo/logo.png" height="55px" width="55px"></a>
    </div>            
    <nav class="navbar">
        <a href="indexAdmin.php">Volver</a>
    </nav>
</header>
<br>
<h1 class="titulos">Gestión de Empleados</h1>
<br>
<br>

<?php

 session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
   header('Location: index.php');
   exit();
}

// Verificar si se envió el formulario de agregar empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Validar y sanitizar los datos ingresados
    // Aquí se puede aplicar la lógica de validación y sanitización según tus necesidades

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

    // Consulta SQL para insertar un nuevo empleado
    $sql = "INSERT INTO empleados (nombre, apellido, telefono, correo) VALUES ('$nombre', '$apellido', '$telefono', '$correo')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        echo '<script>alert("Empleado agregado correctamente");</script>';
        header("Location: {$_SERVER['PHP_SELF']}");
    } else {
        echo "Error al agregar el empleado: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>
<div class="container_empleados">
    <form action="agregar_empleado.php" method="post">
        <input type="hidden" name="accion" value="agregar"> <!-- Campo oculto para indicar la acción -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required> <br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required> <br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required> <br>

        <label for="correo">Correo electrónico:</label><br>
        <input type="email" id="correo" name="correo" required> <br>
        <br>

        <input type="submit" value="Agregar Empleado">
    </form>
</div>
<br>
<br>
<h1 class="titulos">Lista de Empleados</h1>
<br>

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

// Consulta SQL para contar el número total de empleados
$sql_contador = "SELECT COUNT(*) as total_empleados FROM empleados";
$result_contador = mysqli_query($conexion, $sql_contador);

// Obtener el resultado de la consulta
if ($result_contador) {
    $row_contador = mysqli_fetch_assoc($result_contador);
    $total_empleados = $row_contador['total_empleados'];
} else {
    $total_empleados = 0;
    echo "Error al obtener el contador de empleados: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<p>Total de empleados: <?php echo $total_empleados; ?></p>


<input type="text" id="buscador" placeholder="Buscar por ID o nombre">

<br>

<div class="tabla_baja_empleados">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Correo electrónico</th>
            <th>Acciones</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
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

        // Verificar si se envió el formulario de eliminar empleado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
            $id_empleado = $_POST['id_empleado'];

            // Consulta SQL para eliminar un empleado
            $sql_eliminar = "DELETE FROM empleados WHERE id = '$id_empleado'";
            if (mysqli_query($conexion, $sql_eliminar)) {
                echo "Empleado eliminado exitosamente.";
                header("Location: {$_SERVER['PHP_SELF']}");
            } else {
                echo "Error al eliminar el empleado de la tabla empleados: " . mysqli_error($conexion);
            }
        }

        // Consulta SQL para obtener todos los empleados
        $sql_empleados = "SELECT * FROM empleados";

        // Ejecutar la consulta
        $result_empleados = mysqli_query($conexion, $sql_empleados);

        // Verificar si se encontraron empleados
        if (mysqli_num_rows($result_empleados) > 0) {
            // Recorrer los resultados y mostrar los empleados en filas de la tabla
            while ($row_empleado = mysqli_fetch_assoc($result_empleados)) {
                echo "<tr>";
                echo "<td>" . $row_empleado['id'] . "</td>";
                echo "<td>" . $row_empleado['nombre'] . "</td>";
                echo "<td>" . $row_empleado['apellido'] . "</td>";
                echo "<td>" . $row_empleado['telefono'] . "</td>";
                echo "<td>" . $row_empleado['correo'] . "</td>";
                echo "<td>
                <form action='editar_empleado.php' method='post'>
                    <input type='hidden' name='accion' value='editar'>
                    <input type='hidden' name='id_empleado' value='" . $row_empleado['id'] . "'>
                    <input type='submit' value='Editar'>
                </form>
            </td>";
                echo "<td>
                    <form action='agregar_empleado.php' method='post'>
                        <input type='hidden' name='accion' value='eliminar'>
                        <input type='hidden' name='id_empleado' value='" . $row_empleado['id'] . "'>
                        <input type='submit' value='Eliminar'>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron empleados.</td></tr>";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        ?>
        </tbody>
    </table>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buscador = document.getElementById("buscador");
        const filas = document.querySelectorAll("tbody tr");

        buscador.addEventListener("input", function () {
            const consulta = buscador.value.trim().toLowerCase();

            filas.forEach(function (fila) {
                const id = fila.querySelector("td:nth-child(1)").textContent.toLowerCase();
                const nombre = fila.querySelector("td:nth-child(2)").textContent.toLowerCase();
                if (id.includes(consulta) || nombre.includes(consulta)) {
                    fila.style.display = "table-row";
                } else {
                    fila.style.display = "none";
                }
            });
        });
    });
</script>
</body>
</html>
