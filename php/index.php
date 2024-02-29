  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Inicio</title>
</head>
<body>
    <!--<p>CABECERA</p> -->
    <div class="head">         
    
        <div class="logo"> 
            <a href="index.php"><img src="../imagenes/logo/logo.png" heigth="65px" width="65px"></a>
        </div>  
    
    

            <!--<BARRA NAVEGACION</p> -->
            <nav class="navbar">
                
                <a href="#servicios">Servicios</a>
                <a href="#productos">Productos</a>
                <a href="#contacto">Contacto</a>           
                <a href="#about">+INFO</a> 
                <a href="altasesion.php">Iniciar sesion</a>
                    
            </nav>

                <script>
                    function delayScroll(event) {
        event.preventDefault();
        const target = event.target.getAttribute('href');
        setTimeout(function() {
            document.querySelector(target).scrollIntoView({
            behavior: 'smooth'
            });
        }, 500);
        }

        const links = document.querySelectorAll('.navbar a[href^="#"]');
        links.forEach(function(link) {
        link.addEventListener('click', delayScroll);
        });
                </script>

        
    </div>

    <!--<p>INICIO</p> -->
        <header id="header" class="content header">
            <h2 class="title">FLAMENCA ALISADOS</h2>

            
             
            <div class="btn-home">
                <a href="altasesion.php" class="btn">Saca tu Turno !</a>
                <div class="btn-home">
            </div>
            </div>
        </header>

        <!--<p>SERVICIOS</p> -->
        <section id="servicios"class="content services">
            <h2 class="title">Servicios</h2>
            <p> Alisados y tratamientos capilares: Keratinas, Botox, Nutriciones, Uñas: Esculpidas, Capping y Esmaltado semi permanente, Lifting de pestañas y Perfilado, laminado de cejas.</p>
            <a href="servicios.php" class="btn">Saber mas</a>
            <br>
            <br>
            <br>
        </section>

        <!--PRODUCTOS -->
        <section id="productos"class="content products">
            <h2 class="title">Productos</h2>
            <p> Keratinas, Nutriciones, serum para puntas.</p>
            <a href="productos.php" class="btn">Saber más</a>
            <br>
            <br>
            <br>
        </section>

        <!--<p>CONTACTO</p> -->
        <section id="contacto" class="content contact">
            <h2 class="title">Contacto</h2>
            <div class="box-container">
                <!--<p>Caja1</p> -->
                <div class="box">
                    <a href="https://www.facebook.com/ambar.ezeiza"> <i class="fab fa-facebook"></i></a>                 
                    <h3>Flamenca Alisados</h3>
                </div>
                <!--<p>Caja2</p> -->
                <div class="box">        
                    <a href="https://instagram.com/flamenca_alisados?igshid=YmMyMTA2M2Y%3D"> <i class="fab fa-instagram"></i></a>
                    <h3>Flamenca_Alisados</h3>
                </div>
                <!--<p>Caja3</p> -->
                <div class="box">
                    <a href="https://wa.me/541141642979? text= Hola quiero más informacion acerca de tus productos/servicios"> <i class="fab fa-whatsapp"></i></a>               
                    <h3>Whatsapp</h3>
                </div>
            </div>
        </section>

        <!--<p>NOSOTROS</p> -->
        <section id="about"class="contentabout">

            <h3 class="title">Preguntas Frecuentes</h3>
            <h3>¿DEBO VENIR CON TIEMPO AL TURNO?</h3>
            <p>Si, 10 minutos antes o justo a tiempo de la hora</p>
            <h3>¿PUEDO CANCELAR EL TURNO?</h3>
            <p>Si, pueden cancelar el turno siempre y cuando sea 24hs antes, de lo contrario pierden la seña</p>
            <h3>¿PUEDO LLEGAR TARDE AL TURNO?</h3>
            <p>Si, tiemo de espera 15 minutos.
                De todas foras deben avisar que llegan tarde al turno, si no se da por cancelado
            </p>
            <h3>¿PUEDO VENIR ACOMPAÑADA?</h3>
            <p>No, solo si la persona que venga tiene turno antes o despues de vos</p>
            <h3> DATO IMPORTANTE </h3>
            <p> Prohibido venir con menores de edad, ya que el espacio es chico y el producto es fuerte</p>
           
        </section>

        

        <!--<p>UBICACION</p> -->    
        <section class="content ubication">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br> 
            <h2 class="title">Ubicación</h2>

            <?php
                $servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
                $username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
                $password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
                $dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

                $conexion = mysqli_connect($servername, $username, $password, $dbname);

                if (mysqli_connect_errno()) {
                    echo "Error en la conexión a la base de datos 'validar': " . mysqli_connect_error();
                    exit;
                }

                // Consulta SQL para obtener la ubicación actual
                $sql_validar = "SELECT ubicacion FROM ubicacion WHERE id = 1";
                $resultado_validar = mysqli_query($conexion_validar, $sql_validar);

                if ($resultado_validar) {
                    $fila = mysqli_fetch_assoc($resultado_validar);

                    // Verifica si $fila no es nulo antes de intentar acceder a sus elementos
                    if ($fila !== null) {
                        $ubicacion_actual = $fila['ubicacion'];
                        echo "<p>$ubicacion_actual</p>";
                    } else {
                        echo "No se encontraron resultados para la consulta.";
                    }
                } else {
                    echo "Error al obtener la ubicación actual: " . mysqli_error($conexion_validar);
                }

                // Cerrar la conexión a la base de datos "validar"
                mysqli_close($conexion_validar);
                ?>
            
        </section>
</body>
</html>