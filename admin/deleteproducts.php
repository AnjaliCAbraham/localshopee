<?php
include 'connection.php';
$id=$_REQUEST['id'];
$query = "UPDATE `tbl_product` SET `P_availability`='Disabled'  WHERE Product_id=$id"; 
$result = mysqli_query($connection,$query) or die ( mysqli_error());
header("Location: Vproductdetail.php"); 
?>