<?php

session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'usuario') {
  // Si no cumple las condiciones, redirigir al usuario a otra página (por ejemplo, index.php)
 header('Location: index.php');
 exit();
}
include('db.php'); // conexión con la base de datos

// Obtener el ID del usuario desde la sesión
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obtener todos los atributos del usuario
$sql = "SELECT id, rol, usuario, password, email FROM usuario WHERE id = $id_usuario";
$resultado = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if ($resultado->num_rows > 0) {
    // Obtener el resultado de la consulta
    $fila = $resultado->fetch_assoc();
    $id_usuario = $fila['id'];
    $rol = $fila['rol'];
    $nombre_usuario = $fila['usuario'];
    $password = $fila['password'];
    $email_usuario = $fila['email'];
} else {
    // Manejar el caso en que no se encuentre el usuario
    $id_usuario = "ID de usuario no encontrado";
    $rol = "Rol no encontrado";
    $nombre_usuario = "Nombre de usuario no encontrado";
    $password = "Contraseña no encontrada";
    $email_usuario = "Correo electrónico no encontrado";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/tablaadmin.css">
<link rel="stylesheet" href="../css/nav-bar.css">


  <title>Menú de Cliente</title>
</head>
<body>
<header class="head">

<nav class="navbar">
<div class="logo">
                <a href="#"><img src="../imagenes/logo/logo.png" height="65px" width="65px"></a>
            </div>
            <nav class="navbar">
                <a href="#"><?php echo $nombre_usuario; ?></a>
            </nav>
</nav>

</header>
<br>
<br>
  <div class="admin-panel">
    <h2>Menú de Cliente</h2>
    <table>
      <tr>
        <th>Funciones del Cliente</th>
      </tr>
      
      <tr>
        <td><a href="mi_perfil_cliente.php">Mi Perfil</a></td>
      </tr>
      
      <tr>
        <td><a href="turnosUsu.php">Agendar Turnos</a></td>
      </tr>

      <tr>
        <td><a href="ver_mis_turnos.php">Mis Turnos</a></td>
      </tr>

      <tr>
      <td><a href="verProd.php">Ver Productos</a></td>
      </tr>

      <td><a href="cerrarsesion.php">Cerrar Sesion</a></td>
      </tr>
    </table>
  </div>
</body>
</html>
</html>