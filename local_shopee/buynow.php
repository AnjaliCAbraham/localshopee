<?php
include('connection.php');
session_start();
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
 }
 $loginid=$_SESSION['uid'];



?>
