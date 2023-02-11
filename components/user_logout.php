<?php

   include 'connect.php';
   session_start();

   setcookie('user_id', '', time() - 1, '/');
   unset($_SESSION['user_token']);
   session_destroy();

   header("Location:../home.php");

?>