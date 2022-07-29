<?php
include('connection.php');
$caid=$_GET['id'];
$select="SELECT * FROM `tbl_cart`,stock_db WHERE tbl_cart.Product_id=stock_db.Product_id and Cart_id='$caid'";
$result1 = mysqli_query($conn, $select);
$row3 = mysqli_fetch_assoc($result1);
 $qt=$row3['C_Qty'];
 $stock=$row3['Stock'];
 $fqty=$qt+1;
 if($stock>=$fqty)
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