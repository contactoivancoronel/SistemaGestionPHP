<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ver productos</title>
    <link rel="stylesheet" href="../css/rosa.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav-bar.css">

    <script>
    function realizarAccion(id, nombre, precio, descripcion) {
        // Construir el mensaje de WhatsApp
        var mensaje = "Hola Gimena, tengo interés en comprar este artículo: " + nombre + " - Descripción: " + descripcion + " - Precio: $" + precio;

        // Codificar el mensaje para usar en el enlace de WhatsApp
        var mensajeCodificado = encodeURIComponent(mensaje);

        // Construir el enlace de WhatsApp
        var enlaceWhatsApp = "https://wa.me/541141642979?text=" + mensajeCodificado;

        // Redirigir a WhatsApp
        window.location.href = enlaceWhatsApp;
    }
</script>

</head>

<body>

    <header class="head">

        <nav class="navbar">

            <a href="home.php">Volver</a>
        </nav>

    </header>
    <br>
    <br>
    <div class="tabla_ver_product">
        <table>
            <caption>Productos disponibles</caption>

            <thead>
                <tr>

                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>*</th>
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
                if (mysqli_connect_error()) {
                    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
                    exit;
                }

                // Consulta SQL para obtener todos los productos
                $sql_productos = "SELECT * FROM productos";

                // Ejecutar la consulta
                $result_productos = mysqli_query($conexion, $sql_productos);

                // Verificar si se encontraron productos
                if (mysqli_num_rows($result_productos) > 0) {
                    // Recorrer los resultados y mostrar los productos en filas de la tabla
                    while ($row_producto = mysqli_fetch_assoc($result_productos)) {
                        echo "<tr>";
                        echo "<td>" . $row_producto['nombre'] . "</td>";
                        echo "<td>" . $row_producto['descripcion'] . "</td>";
                        echo "<td>" . $row_producto['precio_reventa'] . "</td>";
                        echo "<td><button onclick='realizarAccion(" . $row_producto['id'] . ", \"" . $row_producto['nombre'] . "\", " . $row_producto['precio_reventa'] . ", \"" . $row_producto['descripcion'] . "\")'>Lo Quiero!</button></td>";
                        echo "</tr>";
                    }
                    
                } else {
                    echo "<tr><td colspan='4'>No se encontraron productos.</td></tr>";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conexion);
                ?>
            </tbody>  
    </div>
    <style>/* Agrega estilos para hacer la tabla elegante y responsive */
body {
    font-family: 'Arial', sans-serif;
}

h1 {
    text-align: center;
    color: #333;
}

.tabla_ver_product {
    margin: 20px auto;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

thead {
    background-color: #f2f2f2;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

@media (max-width: 600px) {
    th, td {
        padding: 10px;
    }
}
</style>


</body>

</html>