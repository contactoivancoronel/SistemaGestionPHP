<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Turno</title>
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
            <a href="turnosAdmin.php">Volver</a>
        </nav>
    </header>


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

// Verificar si se envió el formulario de editar turno
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_turno'])) {
    $id_turno = $_POST['id_turno'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $precio = $_POST['precio'];

    // Consulta SQL para actualizar la fecha, hora y precio del turno
    $sql_actualizar_turno = "UPDATE sacar_turnos 
                            SET fecha = '$fecha', hora = '$hora', precio = '$precio'
                            WHERE id = '$id_turno'";

    if (mysqli_query($conexion, $sql_actualizar_turno)) {
        echo '<script>alert("Turno actualizado correctamente");</script>';
        header("Location: turnosAdmin.php"); // Reemplaza con el nombre de tu página de turnos
    } else {
        echo "Error al actualizar el turno: " . mysqli_error($conexion);
    }
}

// Obtener el ID del turno desde la URL
if (isset($_GET['id_turno'])) {
    $id_turno = $_GET['id_turno'];

    // Consulta SQL para obtener los detalles del turno seleccionado
    $sql_obtener_turno = "SELECT * FROM sacar_turnos WHERE id = '$id_turno'";
    $resultado_turno = mysqli_query($conexion, $sql_obtener_turno);

    // Verificar si la consulta fue exitosa
    if ($resultado_turno) {
        $fila_turno = mysqli_fetch_assoc($resultado_turno);
    } else {
        echo "Error al obtener los detalles del turno: " . mysqli_error($conexion);
        exit;
    }
} else {
    echo "ID del turno no proporcionado.";
    exit;
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<!-- Formulario de edición -->
<h2>Editar Turno</h2>
<form action="editar_turno.php" method="post">
    <input type="hidden" name="id_turno" value="<?php echo $id_turno; ?>">

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" value="<?php echo $fila_turno['fecha']; ?>" required>

    <label for="hora">Hora:</label>
    <input type="time" id="hora" name="hora" value="<?php echo $fila_turno['hora']; ?>" required>

    <label for="precio">Precio:</label>
    <input type="number" step="0.01" id="precio" name="precio" value="<?php echo $fila_turno['precio']; ?>" required>

    <br>
    <br>
    <input type="submit" value="Actualizar Turno">
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
    input[type="number"] {
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

</body>
</html>
