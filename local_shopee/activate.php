<?php
include('connection.php');
$caid=$_GET['id'];
$update="UPDATE `tbl_login` SET `Status`='1' WHERE Login_id='$caid'";
$update2=mysqli_query($conn,$update);
//header("Location:login.html");
?>