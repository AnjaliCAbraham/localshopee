<?php
include('connection.php');
$orderid=$_GET['id'];
$result = mysqli_query($conn,"UPDATE `tbl_order` SET `Status`='Cancled' WHERE `Order_id`='$orderid'");
header("Location:orderhistory.php");
?>