<!DOCTYPE html>
<html lang="en">
<html>
<head>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/nav-bar.css">
<link rel="stylesheet" href="../css/tablaadmin.css">



<?php

session_start();

// Verificar si el usuario está autenticado y tiene el rol de administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
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


  <title>Menú de Administrador</title>
</head>
<body>

<header class="head">
            <div class="logo">
                <a href="#"><img src="../imagenes/logo/logo.png" height="65px" width="65px"></a>
            </div>
            <nav class="navbar">
                <a href="#"><?php echo $nombre_usuario; ?></a>
            </nav>
        </header>


  <br>
  <br>
  <div class="admin-panel">
    <h2>Menú de Administrador</h2>
    <table>
      <tr>  
        <th>Funciones del administrador</th>
      </tr>
      
      <tr>
        <td><a href="mi_perfil.php">Mi Perfil</a></td>
      </tr>

      <tr>
        <td><a href="caja_admin.php">Caja</a></td>
      </tr>

      <tr>
        <td><a href="agregar_empleado.php">Gestion de Empleados</a></td>
      </tr>
      <tr>
        <td><a href="prodAdmin.php">Gestión de Productos</a></td>
      </tr>
     
      <tr>
        <td><a href="servAdmin.php">Gestión de Servicios</a></td>
      </tr>
      
      <tr>
        <td><a href="turnosAdmin.php">Gestión de Turnos</a></td>
      </tr>
     
      <tr>
        <td><a href="lista_turnos_admin.php">Mi Agenda</a></td>
      </tr>

      <tr>
        <td><a href="index_estadisticas.php">Panel de Estadisticas</a></td>
      </tr>

      <tr>
        <td><a href="ubicacion.php">Cambiar ubicación - Google Maps</a></td>
      </tr>

      <tr>
        <td><a href="cerrarsesion.php">Cerrar Sesion</a></td>
      </tr>

    </table>
  </div>
</body>
</html>
</html>