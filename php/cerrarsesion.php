<?php 


session_start();

if(isset($_SESSION['id_usuario'])){
    echo "existe sesión";
    session_destroy();
    header('Location:index.php');
}else{
   echo "no existe sesión";
}

//session_start();
//session_destroy();
//header('Location:index.php');

?>