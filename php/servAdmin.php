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

session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
   header('Location: index.php');
   exit();
}

// Verificar si se envió el formulario de agregar servicio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    $nombreServ = $_POST['nombreServ'];
    $descripServ = $_POST['descripServ'];
    $precioServ = $_POST ['precioServ'];
    // Validar y sanitizar los datos ingresados
    // Aquí se puede aplicar la lógica de validación y sanitización según tus necesidades

    // Consulta SQL para insertar un nuevo servicio sin proporcionar el valor de la columna 'id'
    $sql = "INSERT INTO servicios (servicio, descripcion, precio) VALUES ('$nombreServ', '$descripServ', '$precioServ')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Redireccionar después de agregar el servicio para evitar el reenvío del formulario
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo "Error al agregar el servicio: " . mysqli_error($conexion);
    }
}

// Verificar si se envió el formulario de eliminar servicio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    // Verificar si se proporcionó el ID del servicio a eliminar
    if (isset($_POST['eliminar_id_servicio'])) {
        // Obtener el ID del servicio a eliminar
        $eliminar_id_servicio = $_POST['eliminar_id_servicio'];

        // Consulta SQL para eliminar el servicio
        $sql_eliminar = "DELETE FROM servicios WHERE id = '$eliminar_id_servicio'";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $sql_eliminar)) {
            // Redireccionar después de eliminar el servicio para evitar el reenvío del formulario
            header("Location: {$_SERVER['PHP_SELF']}");
            exit;
        } else {
            echo "Error al eliminar el servicio: " . mysqli_error($conexion);
        }
    } else {
        echo "ID de servicio no proporcionado.";
    }
}

// Consulta SQL para obtener todos los servicios
$sql_servicios = "SELECT * FROM servicios";

// Ejecutar la consulta
$result_servicios = mysqli_query($conexion, $sql_servicios);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
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

        .titulos {
            text-align: center;
            margin: 10px 0;
        }

        .container_servicios {
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
        input[type="number"] {
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

        .tabla_servicios {
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
    <title>Servicios</title>
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
<br>
<br>

<h2 class="titulos">Gestión de Servicios</h2>
<br>
<div class="container_servicios">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="nombreServ">Servicio:</label> 
        <input type="text" id="nombreServ" name="nombreServ" required> <br>
        <br>
        <label for="descripServ">Descripcion:</label> 
        <input type="text" id="descripServ" name="descripServ" required> <br>
        <br>
        <label for="precioServ">Precio:</label> 
        <input type="number" id="precioServ" name="precioServ" required min="1"> <br>
        <br>
        <input type="hidden" name="accion" value="agregar">
        <input type="submit" value="Agregar Servicio">
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

    input[type="text"] {
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
</div>

<br>
<br>
<h1>Lista de servicios<h2>
<input type="text" id="buscador" placeholder="Buscar por ID de servicio">
<div class="tabla_servicios">
    <table>
        <br>
        <thead>
            <tr>
                <th>ID</th>
                <th>Servicio</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Acciones</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si se encontraron servicios
            if (mysqli_num_rows($result_servicios) > 0) {
                // Recorrer los resultados y mostrar los servicios en filas de la tabla
                while ($row_servicio = mysqli_fetch_assoc($result_servicios)) {
                    echo "<tr>";
                    echo "<td>" . $row_servicio['id'] . "</td>";
                    echo "<td>" . $row_servicio['servicio'] . "</td>";
                    echo "<td>" . $row_servicio['descripcion'] . "</td>";
                    echo "<td>" . $row_servicio['precio'] . "</td>";
                    echo "<td>
                        <form action='editar_servicio.php' method='post'>
                            <input type='hidden' name='accion' value='editar'>
                            <input type='hidden' name='id_servicio' value='" . $row_servicio['id'] . "'>
                            <input type='submit' value='Editar'>
                        </form>
                    </td>";
                    echo "<td>
                            <form action='{$_SERVER['PHP_SELF']}' method='post'>
                                <input type='hidden' name='accion' value='eliminar'>
                                <input type='hidden' name='eliminar_id_servicio' value='" . $row_servicio['id'] . "'>
                                <input type='submit' value='Eliminar'>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron servicios.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buscador = document.getElementById("buscador");
        const filas = document.querySelectorAll(".tabla_servicios tbody tr");

        buscador.addEventListener("input", function () {
            const consulta = buscador.value.trim().toLowerCase();

            filas.forEach(function (fila) {
                const id = fila.querySelector("td:nth-child(1)").textContent.toLowerCase();
                if (id.includes(consulta)) {
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