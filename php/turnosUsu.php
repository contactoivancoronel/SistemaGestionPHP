<?php
session_start(); // Inicializar la sesión

// Resto del código y HTML del archivo
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/mis_turnos.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav-bar.css">

    <script>
        function confirmarSeleccion(identificador) {
            if (confirm("¿Estás seguro de que deseas seleccionar este turno?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                        // Eliminar la fila correspondiente al turno seleccionado
                        var fila = document.getElementById(identificador);
                        fila.parentNode.removeChild(fila);
                    }
                };
                xhttp.open("GET", "insertar_turno_seleccionado.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>&id_turno=" + identificador, true);
                xhttp.send();
            }
        }
    </script>
</head>

<body>

    <header class="head">

        <nav class="navbar">

            <a href="home.php">Volver</a>
        </nav>

    </header>

    <?php
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        echo "Error: Usuario no autenticado.";
        exit();
    }

    // Verificar si se ha guardado el arreglo de turnos seleccionados en la sesión
    if (!isset($_SESSION['turnos_seleccionados'])) {
        $_SESSION['turnos_seleccionados'] = array();
    }
    ?>
    <br>
    <br>
    <br>
    <h1>Turnos Disponibles</h1>
    <div class="tabla_turnos">
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Empleado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
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
                    echo "<td><button onclick='confirmarSeleccion(\"" . $fila['id'] . "\")'>Seleccionar</button></td>";
                    echo "</tr>";

                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conexion);
                ?>
                <style>
                    .tabla_turnos {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .tabla_turnos table {
                        width: 100%;
                        border: 1px solid #ccc;
                    }

                    .tabla_turnos th,
                    .tabla_turnos td {
                        padding: 8px;
                        text-align: left;
                    }

                    .tabla_turnos thead {
                        background-color: #f2f2f2;
                    }

                    .tabla_turnos th {
                        font-weight: bold;
                    }

                    .tabla_turnos tbody tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }

                    .tabla_turnos tbody tr:hover {
                        background-color: #eaeaea;
                    }

                    .tabla_turnos button {
                        padding: 4px 8px;
                        background-color: #4CAF50;
                        color: white;
                        border: none;
                        cursor: pointer;
                    }

                    .tabla_turnos button:hover {
                        background-color: #45a049;
                    }
                </style>
            </tbody>
        </table>
    </div>
</body>

</html>