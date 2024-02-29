<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/turnos_admin.css">
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

        .titulo {
            text-align: center;
            margin: 10px 0;
        }

        .container_agregar_turnos {
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

        input[type="date"],
        input[type="time"],
        input[type="number"],
        select {
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

        .tabla_turnos_agregados {
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

        button {
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <title>Gestion de Turnos</title>
</head>
<body>
<header class="head">
    <div class="logo">
        <a href="indexAdmin.php"><img src="../imagenes/logo/logo.png" height="65px" width="65px"></a>
    </div>
    <nav class="navbar">
        <a href="indexAdmin.php">Volver</a>
    </nav>
</header>

<?php
$servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
$username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
$password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
$dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión a "servicios" fue exitosa
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos 'servicios': " . mysqli_connect_error();
    exit;
}

session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
   header('Location: index.php');
   exit();
}

// Consulta SQL para obtener los registros de la tabla "servicios"
$sql_servicios = "SELECT id, servicio FROM servicios";
$resultado_servicios = mysqli_query($conexion_servicios, $sql_servicios);

// Verificar si la consulta de la tabla "servicios" fue exitosa
if (!$resultado_servicios) {
    echo "Error al obtener los registros de la tabla 'servicios': " . mysqli_error($conexion_servicios);
    exit;
}

// Cerrar la conexión a la base de datos "servicios"
mysqli_close($conexion);

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $servicio = $_POST['servicio'];
    $precio = $_POST['precio'];
    $empleado = $_POST['empleado'];

    // Consulta SQL para insertar un nuevo turno con el empleado asignado
    $sql = "INSERT INTO sacar_turnos (fecha, hora, servicio, precio, empleado_id) VALUES ('$fecha', '$hora', '$servicio', '$precio', '$empleado')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        echo "Turno agregado correctamente";
        header("Location: {$_SERVER['PHP_SELF']}");
    } else {
        echo "Error al agregar el turno: " . mysqli_error($conexion);
    }
}

// Consulta SQL para obtener los empleados
$sql_empleados = "SELECT id, nombre, apellido FROM empleados";
$resultado_empleados = mysqli_query($conexion, $sql_empleados);

// Verificar si la consulta de empleados fue exitosa
if (!$resultado_empleados) {
    echo "Error al obtener los empleados: " . mysqli_error($conexion);
    exit;
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
<br>
<br>
<!-- ACA EL ADMINISTRADOR AGREGA LOS TURNOS DISPONIBLES -->
<div class="container_agregar_turnos">
    <h2 class="titulo">Agregar Turnos Disponibles</h2>
    <br>
    <br>
    <form action="turnosAdmin.php" method="post">

        <label for="servicio">Servicio:</label>
        <select id="servicio" name="servicio" required>
            <?php while ($fila = mysqli_fetch_assoc($resultado_servicios)) : ?>
                <option value="<?php echo $fila['servicio']; ?>"><?php echo $fila['servicio']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required>
       

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" id="precio" name="precio" required>

        <label for="empleado">Empleado:</label>
        <select id="empleado" name="empleado" required>
            <?php while ($fila = mysqli_fetch_assoc($resultado_empleados)) : ?>
                <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre'] . ' ' . $fila['apellido']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <br>
        <input type="submit" value="Agregar Turno">
    </form>
    <style>
    form {
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="date"],
    input[type="time"],
    input[type="number"],
    select {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
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
</style>
    <br>
    <br>
</div>

<?php
// Verificar si se ha guardado el arreglo de turnos seleccionados en la sesión
if (!isset($_SESSION['turnos_seleccionados'])) {
    $_SESSION['turnos_seleccionados'] = array();
}
?>
<br>
<br>
<br>
<h2 class="titulo">Turnos Disponibles</h2>
    <div class="tabla_turnos_agregados">
        <br>
        <br>
        <table>

            <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Precio</th>
                <th>Empleado</th>
                <th>Acciones</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Establecer la conexión a la base de datos
            $conexion = mysqli_connect($servername, $username, $password, $dbname);

            // Verificar si la conexión fue exitosa
            if (mysqli_connect_errno()) {
                echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
                exit;
            }

            // Consulta SQL para obtener los turnos disponibles y el nombre del empleado asociado
            $sql = "SELECT t.id, t.fecha, t.hora, t.servicio, t.precio, t.empleado_id, e.nombre, e.apellido 
                    FROM sacar_turnos t
                    LEFT JOIN empleados e ON t.empleado_id = e.id
                    WHERE t.disponible = 1";

            $resultado = mysqli_query($conexion, $sql);

            // Mostrar los turnos disponibles en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                // Verificar si el turno ya ha sido seleccionado por el usuario
                if (in_array($fila['id'], $_SESSION['turnos_seleccionados'])) {
                    continue; // Saltar a la siguiente iteración del bucle
                }

                echo "<tr id='" . $fila['id'] . "'>";
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td>" . $fila['hora'] . "</td>";
                echo "<td>" . $fila['servicio'] . "</td>";
                echo "<td>" . $fila['precio'] . "</td>";
                // Obtener el nombre del empleado asociado al turno (si existe)
                $empleado_id = $fila['empleado_id'];
                $nombre_empleado = "";
                if ($empleado_id) {
                    $sql_empleado = "SELECT nombre, apellido FROM empleados WHERE id = '$empleado_id'";
                    $resultado_empleado = mysqli_query($conexion, $sql_empleado);
                    $fila_empleado = mysqli_fetch_assoc($resultado_empleado);
                    $nombre_empleado = $fila_empleado['nombre'] . ' ' . $fila_empleado['apellido'];
                }
                echo "<td>" . $nombre_empleado . "</td>";
                echo "<td><button onclick='editarTurno(\"" . $fila['id'] . "\")'>Editar turno</button></td>";   
                echo "<td><button onclick='confirmarEliminacion(\"" . $fila['id'] . "\")'>Eliminar turno</button></td>";
                echo "</tr>";
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
            ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarTurno(idTurno) {
        // Redirige a la página de edición con el ID del turno seleccionado
        window.location.href = 'editar_turno.php?id_turno=' + idTurno;
    }

    function confirmarEliminacion(idTurno) {
        if (confirm('¿Estás seguro de que deseas eliminar este turno?')) {
            // Aquí puedes hacer una petición AJAX para eliminar el turno del servidor
            // Por ahora, simplemente redireccionamos a la misma página con el parámetro id_turno
            window.location.href = 'eliminar_turno.php?id_turno=' + idTurno;
        }
    }
    </script>
</body>
</html>
