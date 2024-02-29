<?php
session_start();


// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
   header('Location: index.php');
   exit();
}

// Establecer la conexión a la base de datos
$servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
$username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
$password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
$dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Obtener el número de trabajos concretados esta semana
$sql_trabajos_semana = "SELECT COUNT(*) AS trabajos_semana FROM turnos_concretados WHERE YEARWEEK(fecha_hora_concretado) = YEARWEEK(CURDATE())";
$resultado_semana = $conexion->query($sql_trabajos_semana);
$fila_semana = $resultado_semana->fetch_assoc();
$trabajos_semana = $fila_semana['trabajos_semana'];

// Obtener el número de trabajos concretados este mes
$sql_trabajos_mes = "SELECT COUNT(*) AS trabajos_mes FROM turnos_concretados WHERE MONTH(fecha_hora_concretado) = MONTH(CURDATE())";
$resultado_mes = $conexion->query($sql_trabajos_mes);
$fila_mes = $resultado_mes->fetch_assoc();
$trabajos_mes = $fila_mes['trabajos_mes'];

// Obtener los datos del gráfico
$datos_grafico = array();
$nombre_dias = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado','Domingo');

// Consulta para obtener el número de trabajos concretados por día de la semana
for ($i = 0; $i < 7; $i++) {
    $sql_trabajos_dia = "SELECT COUNT(*) AS trabajos_dia FROM turnos_concretados WHERE WEEKDAY(fecha_hora_concretado) = " . $i;
    $resultado_dia = $conexion->query($sql_trabajos_dia);
    $fila_dia = $resultado_dia->fetch_assoc();
    $trabajos_dia = $fila_dia['trabajos_dia'];
    $datos_grafico[] = $trabajos_dia;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <style>
        /* Estilos adicionales */
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

        .estadisticas {
            text-align: center;
            margin: 20px;
        }

        .grafico {
            margin: 20px auto;
            max-width: 100%;
            width: 90%;
        }
    </style>
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

    <h1>Estadísticas</h1>
    <div class="estadisticas">
        <p>Trabajos concretados esta semana: <?php echo $trabajos_semana; ?></p>
        <p>Trabajos concretados este mes: <?php echo $trabajos_mes; ?></p>
    </div>

    <div class="grafico">
        <canvas id="grafico-semana"></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('grafico-semana').getContext('2d');

            // Datos para el gráfico
            var datos_grafico = <?php echo json_encode($datos_grafico); ?>;
            var nombre_dias = <?php echo json_encode($nombre_dias); ?>;

            // Crear el gráfico
            var grafico = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nombre_dias,
                    datasets: [{
                        label: 'Trabajos concretados por día',
                        data: datos_grafico,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
