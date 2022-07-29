<?php
include('connection.php');
session_start();
if(!isset($_SESSION['uid']))
{
   header("location:logout.php");
}
 $login=$_SESSION['uid'];
$id=$_GET['id'];
$sql1="SELECT * from tbl_wishlist where Product_id = '$id' and User_id='$login'";
$sql2=mysqli_query($conn,$sql1);
if($sql2->num_rows>0){
    echo '<script>alert("Item already exist")</script>';
    header("Location:../local_shopee/wishlist.php"); 
}else{
$sql="INSERT INTO `tbl_wishlist`(`Product_id`, `User_id`) VALUES ('$id','$login')";
$sqlu=mysqli_query($conn,$sql);
 header("Location:../local_shopee/wishlist.php"); 
}
?>