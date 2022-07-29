<?php
include('connection.php');
if(isset($_POST['pay_id']) && isset($_POST['amount']) && isset($_POST['cartid'])){
    $pay_id= $_POST['pay_id'];
    $amount= $_POST['amount'];
    $cartid= $_POST['cartid'];

    $query="INSERT INTO `tbl_payment`(`Payment_id`, `Cart_id`, `Date`, `Payment`) VALUES ('$pay_id','$cartid','$amount','Success')";
    mysqli_query($conn,$query);
}
?>