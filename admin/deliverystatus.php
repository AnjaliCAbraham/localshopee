<?php
include 'connection.php';
$id=$_GET['id'];
$result = mysqli_query($connection,"Update tbl_delivery set D_Status="Shipped" where D_id=$id");
header("Location:Vdelivery.php");
?>