<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
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

        .container_productos {
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
        input[type="number"],
        input[type="file"] {
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

        .tabla_baja_productos {
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
</head>
<body>
<header class="head">
    <div class="logo">
        <a href="indexAdmin.php"><img src="../imagenes/logo/logo.png" height="55px" width="55px"></a>
    </div>            
    <nav class="navbar">
        <a href="indexAdmin.php">Volver</a>
    </nav>
</header>
<br>
<br>
<h6 class="titulos">Gestión de Productos</h6>
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

// Verificar si se envió el formulario de agregar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $precio_reventa = $_POST['precio_reventa'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];
    $stock = $_POST['stock'];
    // Validar los datos ingresados

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

    // Consulta SQL para insertar un nuevo producto
    $sql = "INSERT INTO productos (nombre, precio, precio_reventa, descripcion, imagen, stock, cantidad_vendida, ganancias_totales) VALUES ('$nombre', '$precio', '$precio_reventa', '$descripcion', '$imagen', '$stock', '0', '0')";   
     //DATOS DE LA IMAGEN

    //$nombre_imagen = $_FILES ['imagen'] ['name'] ;
    //$tipo_imagen = $_FILES ['imagen'] ['type'];
    //$tamanio_imagen = $_FILES ['imagen'] ['size'];

    //RUTA DE LA CARPETA DE DESTINO
    //$carpeta_destino = $_SERVER ['DOCUMENT_ROOT'] . '../imagenes/productos/';

    //MOVEMOS LA IMAGEN DEL DIRECTORIO TEMPORAL

    //move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.$nombre_imagen);
        // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        echo '<script>alert("Producto agregado correctamente");</script>';
        header("Location: {$_SERVER['PHP_SELF']}");
    } else {
        $error = "Error al agregar el producto: " . mysqli_error($conexion);
        echo '<script>alert("' . $error . '");</script>';
    }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    }
?>
<div class="container_productos">
    <form action="prodAdmin.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="accion" value="agregar"> 
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required> <br>
        <br>
        <label for="descripcion">Descripcion:</label>
        <input type="text" id="descripcion" name="descripcion" required> <br>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required min="1"> <br>
        <br> 
        <label for="precio_reventa">Precio de reventa:</label>
        <input type="number" id="precio_reventa" name="precio_reventa" required min="1"> <br>
        <br>        
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" required accept="image/*"> <br>
        <br>     
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required min="1">
        <br>
        <br>
        <br>
        <input type="submit" value="Agregar Producto">
    </form>       
</div>
<br>
<br>
<br>
<h1 class="titulos">Lista de Productos</h1>
<br>
<input type="text" id="buscador" placeholder="Buscar por ID de producto">
<div class="tabla_baja_productos">
    <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Precio de reventa</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        <tbody>

                    <?php
                    // Verificar si se envió el formulario de eliminar producto
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
                        // Verificar si se proporcionó el ID del producto a eliminar
                        if (isset($_POST['id_producto'])) {
                            // Obtener el ID del producto a eliminar
                            $id_producto = $_POST['id_producto'];

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

                            // Consulta SQL para eliminar el producto
                            $sql_eliminar = "DELETE FROM productos WHERE id = '$id_producto'";


                            if (isset($id_producto)) {
                                if (mysqli_query($conexion, $sql_eliminar)) {
                                    echo '<script>alert("Producto eliminado exitosamente.");</script>';
                                } else {
                                    $error = "Error al eliminar el producto: " . mysqli_error($conexion);
                                    echo '<script>alert("' . $error . '");</script>';
                                }
                                // Cerrar la conexión a la base de datos
                                mysqli_close($conexion);
                            } else {
                                echo '<script>alert("ID de producto no proporcionado.");</script>';
                            }
                        }
                    }
                    ?>

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
                            echo "<td>" . $row_producto['id'] . "</td>";
                            echo "<td>" . $row_producto['nombre'] . "</td>";
                            echo "<td>" . $row_producto['descripcion'] . "</td>";
                            echo "<td>" . $row_producto['precio'] . "</td>";
                            echo "<td>" . $row_producto['precio_reventa'] . "</td>";                       
                            echo "<td>" . $row_producto['stock'] . "</td>";
                            echo "<td>
                                <form action='venta_producto.php' method='post'>
                                    <input type='hidden' name='accion' value='vender'>
                                    <input type='hidden' name='id_producto' value='" . $row_producto['id'] . "'>
                                    <input type='submit' value='Venta'>
                                </form>
                            </td>";
                            echo "<td>
                                <form action='editar_producto.php' method='post'>
                                    <input type='hidden' name='accion' value='editar'>
                                    <input type='hidden' name='id_producto' value='" . $row_producto['id'] . "'>
                                    <input type='submit' value='Editar'>
                                </form>
                            </td>";
                            echo "<td>
                                <form action='prodAdmin.php' method='post'>
                                        <input type='hidden' name='accion' value='eliminar'>
                                        <input type='hidden' name='id_producto' value='" . $row_producto['id'] . "'>
                                        <input type='submit' value='Eliminar producto'>
                                    </form>
                                </td>";                           
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No se encontraron productos.</td></tr>";
                    }

                    // Cerrar la conexión a la base de datos
                    mysqli_close($conexion);
                    ?>
            </tbody>
    </table>
    </div>

        <style>
            body {
        background-color: #f5f5f5;
        background-image: linear-gradient(to bottom right, #c39bd3, #f9f0ff);
        color: #333;
        font-family: Arial, sans-serif;
        }
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }
            .resumen-productos {
                margin-bottom: 10px;
                font-weight: bold;
            }
        </style>

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

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const buscador = document.getElementById("buscador");
                const filas = document.querySelectorAll("tbody tr");

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
