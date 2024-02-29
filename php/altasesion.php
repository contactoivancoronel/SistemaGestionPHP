<?php
session_start(); // Inicializar la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/altasesion.css">
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Iniciar sesion</title>
</head>
<body>

    <header class="head" >  
        
        <div class="logo"> 
        <a href="index.php"><img src="../imagenes/logo/logo.png" heigth="65px" width="65px"></a>
        </div>  
        <nav class="navbar">
                <a href="index.php">Inicio</a>
                <a href="index.php #about">+INFO</a>
                <a href="index.php #contacto">Contacto</a>
                <a href="servicios.php">Servicios</a>
                <a href="productos.php">Productos</a>  
            </nav>
    </header>
    <section>

            <form action="validar.php" method="post" class="form-altasesion"> 

                <h6>INICIAR SESION</h6>
                <br>
                <br>
                    <div class="container">
                        <div class="inputs-form1">
                            <p>Usuario</p>
                            <br>
                            <input class="user" type="text" placeholder="Ingrese su usuario" name="usuario" required> 
                        </div>
                <br>
                        <div class="inputs-form1">

                            <p>Contraseña</p>
                            <br>
                            <input class="user" type="password" placeholder="Ingrese su contraseña" name="password" required>

                        </div>
                    </div>
                <br>
                <div class="botones-form">
                    <button type="submit" name="boton" class="boton1">Ingresar</button>
                    <a class="boton1" href="registro.php" style="background-color: #3498db;">Registrarse </a>
                
                </div>
            </form>
            <form action="recupera.php" method="post" class="form-altasesion"> 

                    <br>
                    <div class="botones-form">
                        <button type="submit" name="boton" class="boton1">¿Olvidaste tu contraseña?</button>

                    </div>
            </form>
    </section>    
</body>
</html>   