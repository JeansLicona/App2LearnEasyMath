<?php
session_start();
 //Elimina todas las variables de sesión 
 session_unset(); 
 session_destroy();

 header('Location: ../sitio/login.php');
 exit();
?>