<?php
include 'connection.php';
$id=$_REQUEST['id'];
$query = "DELETE FROM `tbl_cart` WHERE Cart_id=$id"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("Location: cart.php"); 
?>