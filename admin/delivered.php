<?php
include 'connection.php';
$orderid=$_GET['oid'];
$dreq=$_GET['dreq'];
$au=mysqli_query($connection,"SELECT * FROM `tbl_order` WHERE  Order_id=$orderid");
$row=mysqli_fetch_array($au);
$cartid=$row['Cart_id'];
    $update1="UPDATE `tbl_order` SET `Status`='delivered' WHERE  `Order_id`='$orderid'";
    $update2=mysqli_query($connection,$update1);
    $update3="UPDATE `tbl_delivery_request` SET `status`='delivered' WHERE `Delivery_id`='$dreq'";
    $update4=mysqli_query($connection,$update3);
    $update5="UPDATE `tbl_cart` SET `Status`='delivered' WHERE `Cart_id`='$cartid'";
    $update6=mysqli_query($connection,$update5);
    header("Location:accepteddelivery.php");
?>