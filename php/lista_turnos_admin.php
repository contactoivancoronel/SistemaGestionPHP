<?php
session_start(); // Inicializar la sesión
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mis_turnos.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
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

        h1 {
            text-align: center;
            margin: 10px 0;
        }

        .tabla_turnos {
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
    <script>
        function cancelarTurno(identificador) {
            if (confirm("¿Estás seguro de que deseas cancelar este turno?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                        // Recargar la página para actualizar la lista de turnos
                        location.reload();
                    }
                };
                xhttp.open("GET", "cancelar_turno.php?id_turno=" + identificador, true);
                xhttp.send();
            }
        }
    </script>
    <title>Agenda de Turnos</title>
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
   <h1>Turnos Agendados</h1>
   <br>
<div class="tabla_turnos">
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio a realizarse</th>
                <th>Precio</th>
                <th>Empleado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            

            // Configuración de la conexión a la base de datos "turnos"
            $servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
            $username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
            $password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
            $dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.
            
            $conexion = mysqli_connect($servername, $username, $password, $dbname);
            // Verificar si la conexión a la base de datos "turnos" fue exitosa
            if (mysqli_connect_errno()) {
                echo "Error en la conexión a la base de datos 'turnos': " . mysqli_connect_error();
                exit;
            }

            // Consulta SQL para obtener los turnos de todos los usuarios
            $sql = "SELECT ts.*, t.id, t.fecha, t.hora, t.servicio, t.precio, e.nombre, e.apellido
            FROM turnos_seleccionados ts
            LEFT JOIN sacar_turnos t ON ts.id_turno = t.id
            LEFT JOIN empleados e ON t.empleado_id = e.id";

            $resultado = mysqli_query($conexion, $sql);

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td>" . $fila['hora'] . "</td>";
                echo "<td>" . $fila['servicio'] . "</td>";
                echo "<td>" . $fila['precio'] . "</td>";
                echo "<td>" . $fila['nombre'] . " " . $fila['apellido'] . "</td>"; // Mostrar nombre y apellido del empleado
                echo "<td>
                <form action='concretar_turno.php' method='post'>
                    <input type='hidden' name='id_turno' value='" . $fila['id_turno'] . "'>
                    <button type='submit'>Turno Concretado</button>
                </form>
              </td>";
            }

   
            

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
