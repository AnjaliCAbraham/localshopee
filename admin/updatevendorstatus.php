<?php
include 'connection.php';
$id=$_GET['id'];
$result = mysqli_query($connection,"Update tbl_login set Status=1 where Login_id=$id");
header("Location:vendorverify.php");
?>