<?php
include('connection.php');
session_start();
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
 }
 $loginid=$_SESSION['uid'];
$sql5="SELECT * ,tbl_product.P_price*tbl_cart.C_Qty as Total_Price FROM tbl_product,tbl_cart where tbl_product.Product_id=tbl_cart.Product_id and tbl_cart.User_id='$loginid' and tbl_cart.status='Added'";			
$result = $conn->query($sql5);
while($row5 = $result->fetch())
{
    $date=  date("Y/m/d");
    $cartid=$row5['Cart_id'];
    $totalprice=$row5['Total_Price'];
    $query="INSERT INTO `tbl_payment`(`Cart_id`, `Date`, `Payment`) VALUES ('$cartid','$amount','Success')";
    mysqli_query($conn,$query);
}
?>