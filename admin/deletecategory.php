<?php
include 'connection.php';
$id=$_GET['id'];
$result = mysqli_query($connection,"UPDATE `tbl_category` SET `status`='disabled' WHERE Category_id=$id");
header("Location:categorydetail.php");
?>