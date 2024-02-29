<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/productos.css">
    <title>Productos</title>
</head>

<body>
    <div class="head">

        <div class="logo">
            <a href="index.php"><img src="../imagenes/logo/logo.png" height="65px" width="65px" alt=""></a>
        </div>

        <!-- BARRA DE NAVEGACIÓN -->
        <nav class="navbar">
            <a href="index.php">Inicio</a>
            <a href="servicios.php">Servicios</a>
            <a href="index.php#contacto">Contacto</a>
            <a href="index.php#about">+info</a>
            <a href="altasesion.php">Iniciar sesión</a>
        </nav>
    </div>

    <style>

        .centrar {
            text-align: center;
            margin-top: 20px;
        }

        .consultar-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .consultar-btn:hover {
            background-color: #555;
        }
    </style>

    <div class="centrar">
        <a href="altasesion.php" class="consultar-btn">Consultar Stock</a>
    </div>

    <section class="contenido_productos">
        <div class="mostrador" id="mostrador">
            <div class="fila">
                <div class="contenedor-2">
                    <div class="item">


                        <div class="contenedor-foto">
                            <h2 class="titulo-nutricion">Nutrición biotina</h2>
                            <img src="../imagenes/productos/nutricion1.png"height="500px" width="500px" alt="">
                        </div>
                    </div>

                    <div class="item">
                        <div class="contenedor-foto">
                            <h2 class="titulo-nutricion">Levanta muertos</h2>
                            <br>
                            <img src="../imagenes/productos/nutricion2.png"height="500px" width="500px" alt="">
                        </div>
                    </div>
                </div>
                
                <div class="contenedor-3">
                    <div class="item">
                        <div class="contenedor-foto">
                            <h2 class="titulo-nutricion" >Queratina y colágeno</h2>
                            <img src="../imagenes/productos/nutricion3.png"height="500px" width="500px" alt="">
                        </div>
                    </div>

                    <div class="item">
                        <div class="contenedor-foto">
                            <h2 class="titulo-nutricion">Coco y vainilla</h2>
                            <br>
                            <img src="../imagenes/productos/nutricion4.png"height="500px" width="500px" alt="">
                        </div>
                    </div>
                </div>

                 <div class="contenedor-4">
                    <div class="item">
                        <div class="contenedor-foto">
                            <h2 class="titulo-nutricion">Serum para puntas</h2>
                            <br>
                            <img src="../imagenes/productos/serum.jpeg"height="500px" width="500px" alt="">
                        </div>
                    </div>

                    <div class="item">
                        <div class="contenedor-foto">
                            <h2 class="titulo-nutricion">Oro liquido</h2>
                            <br>
                            <img src="../imagenes/productos/oro_liquido.jpeg"height="500px" width="500px" alt="">
                        </div>
                    </div>
                </div>
                <div class="contenedor-5">
                    <div class="item">
                        <div class="contenedor-foto">
                            <h2 class="titulo-nutricion">Keratina</h2>
                            <br>
                            <img src="../imagenes/productos/keratina.jpeg"height="500px" width="500px" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>