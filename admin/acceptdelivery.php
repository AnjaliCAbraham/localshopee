<?php
include 'connection.php';
$orderid=$_GET['oid'];
$dboy=$_GET['did'];
$userid=$_GET['Userid'];
$sql1="INSERT INTO `tbl_delivery_request`( `Order_id`, `Dboy_id`, `User_id`, `status`) VALUES ('$orderid','$dboy','$userid','deliveryaccepted')";
    mysqli_query($connection,$sql1);
    $update="UPDATE `tbl_order` SET `Status`='deliveryaccepted' WHERE  `Order_id`='$orderid'";
    $update2=mysqli_query($connection,$update);
    header("Location:accepteddelivery.php");
?>