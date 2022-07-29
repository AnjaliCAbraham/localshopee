<?php
   session_start();
   unset($_SESSION["uid"]);
   header('Location:../local_shopee/login.html');
?>
