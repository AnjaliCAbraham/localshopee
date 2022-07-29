<?php
   session_start();
   unset($_SESSION["uid"]);
   unset($_SESSION['uname1']);
   header('Location:../local_shopee/login.html');
?>
