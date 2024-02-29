<?php
define("SITE_URL", "http://localhost/index.php");

define ("MAIL_HOST","heladeriaunlz@gmail.com");
define ("MAIL_USER","contactoivancoronel@gmail.com");
define ("MAIL_PASS","heladeria12345");
define ("MAIL_PORT","465");

session_start();

$num_cart = 0; 

if(isset($_SESSION[''][''])){
    $num_cart = count($_SESSION['']['']);
}
?>