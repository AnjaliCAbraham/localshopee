<?php
include('connection.php');
$caid=$_GET['id'];
$select="SELECT * FROM `tbl_cart` WHERE Cart_id='$caid'";
$result1 = mysqli_query($conn, $select);
$row3 = mysqli_fetch_assoc($result1);
 $qt=$row3['C_Qty'];
 $fqty=$qt-1;
 if($fqty>=1)
 {
    $update="UPDATE `tbl_cart` SET `C_Qty`='$fqty' WHERE Cart_id='$caid'";
    $update2=mysqli_query($conn,$update);
    header("Location:../local_shopee/cart.php");
 }
 else
 {
header("Location:../local_shopee/cart.php");
 }

?>