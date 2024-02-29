<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Inicializar la sesión
include('db.php'); // conexión con la base de datos

// variables que reciben lo ingresado en el index
$USUARIO = $_POST['usuario'];
$PASSWORD = $_POST['password'];

$consulta = "SELECT id, rol FROM usuario WHERE usuario = '$USUARIO' AND password = '$PASSWORD'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_fetch_assoc($resultado);

if ($filas) {
    $_SESSION['id_usuario'] = $filas['id']; // Almacena el ID del usuario en la sesión
    $_SESSION['rol'] = $filas['rol']; // Almacena el rol del usuario en la sesión
    $_SESSION['usuario'] = $USUARIO; // Almacena el nombre de usuario en la sesión
    $_SESSION['password'] = $PASSWORD; // Almacena la pass en la sesión

    // Redirigir al usuario según su rol
    if ($filas['rol'] === 'administrador') {
        header("location: indexAdmin.php");
        exit();
    } else {
        header("location: home.php");
        exit();
    }
} else { // si no es correcto, vuelve a la página y muestra un mensaje de error
    echo "<h1>ERROR USUARIO INCORRECTO</h1>";
    echo "<a href='index.php'>continuar</a>";
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>