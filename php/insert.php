<?php
$servername = "localhost"; // El servidor puede ser diferente en Hostinger, verifica en la configuración de tu cuenta.
$username = "u869947011_flamenca"; // Reemplaza con el nombre de usuario de tu base de datos en Hostinger.
$password = "GimenaFlamenca@2023"; // Reemplaza con la contraseña de tu base de datos en Hostinger.
$dbname = "u869947011_bdhostinger"; // Reemplaza con el nombre de tu base de datos en Hostinger.

$conexion = mysqli_connect($servername, $username, $password, $dbname);
$usu=$_POST['usuario'];
$pas=$_POST['pass'];
$ema=$_POST['email'];
$tel=$_POST['telefono'];






$sql = 'INSERT INTO usuario (usuario, password, email, telefono) VALUES ("'.$usu.'","'.$pas.'","'.$ema.'","'.$tel.'"'.')';
#echo $sql;

#$sql = "INSERT INTO usuario (usuario, password, email, telefono) VALUES ('nombnre','pass','hhh@jjj.com','678676554')";
    if (mysqli_query($conexion, $sql)) {
        // Los datos se guardaron correctamente, redirigir al usuario a otra página
     echo "<p><h2>Alta Realizada </h2></p>";
     echo "<a href='index.php'>Continuar </a>";
       # header('Location: home.php');
    } else {
        // Hubo un error al guardar los datos, mostrar un mensaje de error
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }

    ?>