<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña</title>
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
        <a href="index.php"><img src="../imagenes/logo/logo.png" heigth="65px" width="65px"></a>
    </div>  

    <nav class="navbar">
        <a href="altasesion.php">Volver</a>       
    </nav>

</header>
<br>
<br>
<section>

    <form action="registro.php" method="post" class="form-registro"> 
        
        <h1>Cambio de Contraseña</h1>

        <p> <input type="password" placeholder="Ingrese su nueva contraseña..." name="password" required>  </p>

        <p> <input type="password" placeholder="Repita su nueva contraseña..." name="password" required>  </p>
        
        <div class="botones-form">
            <button class="boton1" type="submit" name="aceptar">Aceptar</button>
            <a class="boton1" href="altasesion.php">Cancelar </a>
        </div>
    </form>

</section>
        
</body>
</html>