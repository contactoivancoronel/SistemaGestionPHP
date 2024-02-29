<?php
session_start(); // Inicializar la sesión
?>
<!DOCTYPE html>
<html>

<head>
    <title>Mis Turnos</title>
    <link rel="stylesheet" href="../css/mis_turnos.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav-bar.css">


</head>
<script>
    function cancelarTurno(identificador) {
        if (confirm("¿Estás seguro de que deseas cancelar este turno?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    // Eliminar la fila correspondiente al turno cancelado
                    var fila = document.getElementById(identificador);
                    fila.parentNode.removeChild(fila);
                }
            };
            xhttp.open("GET", "cancelar_turno.php?id_turno=" + identificador, true);
            xhttp.send();
        }
    }
</script>

<body>
    <header class="head">

        <nav class="navbar">

            <a href="home.php">Volver</a>
        </nav>

    </header>
    <div class="tabla_mis_turnos">
        <table>
            <caption>Mis turnos</caption>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Empleado</th>
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

                // Obtener el ID del usuario actual
                $id_usuario = $_SESSION['id_usuario']; // Asegúrate de tener la variable de sesión 'id_usuario' configurada correctamente
                
                // Consulta SQL para obtener los turnos seleccionados por el usuario actual
                $sql = "SELECT ts.*, t.fecha, t.hora, t.servicio, t.precio, e.nombre, e.apellido
        FROM turnos_seleccionados ts
        INNER JOIN sacar_turnos t ON ts.id_turno = t.id
        LEFT JOIN empleados e ON t.empleado_id = e.id
        WHERE ts.id_usuario = $id_usuario";

                $resultado = mysqli_query($conexion, $sql);

                // Mostrar los turnos seleccionados en la tabla
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr id='" . $fila['id_turno'] . "'>";
                    echo "<td>" . $fila['fecha'] . "</td>";
                    echo "<td>" . $fila['hora'] . "</td>";
                    echo "<td>" . $fila['servicio'] . "</td>";
                    echo "<td>" . $fila['precio'] . "</td>";
                    echo "<td>" . $fila['nombre'] . " " . $fila['apellido'] . "</td>";
                    echo "<td><button onclick='cancelarTurno(\"" . $fila['id_turno'] . "\")'>Cancelar</button></td>";
                    echo "</tr>";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conexion);
                ?>
                <style>
                    .mis_turnos {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .mis_turnos table {
                        width: 100%;
                        border: 1px solid #ccc;
                    }

                    .mis_turnos caption {
                        font-weight: bold;
                        font-size: 1.2em;
                        margin-bottom: 10px;
                    }

                    .mis_turnos th,
                    .mis_turnos td {
                        padding: 8px;
                        text-align: left;
                    }

                    .mis_turnos thead {
                        background-color: #f2f2f2;
                    }

                    .mis_turnos th {
                        font-weight: bold;
                    }

                    .mis_turnos tbody tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }

                    .mis_turnos tbody tr:hover {
                        background-color: #eaeaea;
                    }

                    .mis_turnos button {
                        padding: 4px 8px;
                        background-color: #e74c3c;
                        color: white;
                        border: none;
                        cursor: pointer;
                    }

                    .mis_turnos button:hover {
                        background-color: #c0392b;
                    }
                </style>
            </tbody>

        </table>
    </div>

</body>

</html>