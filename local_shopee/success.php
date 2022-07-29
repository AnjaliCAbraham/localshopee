<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="veiwport" content="width=device-width,initial-scale=1.0">
        <title></title>
        <style>
            a:link, a:visited {
  background-color: #e7e7e7;
  color: black;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: #e7e7e7;
}

</style>
    </head>
    <body>
    <a href="user_home.php" target="_blank">Back to Home</a>
        <h1>Payment Successfully Done!!!</h1>
    </body>
</html>
<?php
include('connection.php');
$cartid=$_GET["cartid"];
$date=  date("Y/m/d");
$query="INSERT INTO `tbl_order`(`Cart_id`, `Date`, `Status`) VALUES ('$cartid','$date','Ordered')";
mysqli_query($conn,$query);
$select="SELECT * FROM `tbl_cart` WHERE Cart_id=$cartid";
$result2= $conn->query($select);
$row2 = $result2->fetch_assoc();
$productid=$row2['Product_id'];
$qty=$row2['C_Qty'];
$select2="SELECT * FROM `tbl_stock` where Product_id=$productid";
$result3= $conn->query($select2);
$row3 = $result3->fetch_assoc();
$stock=$row3['Stock'];
$balance=$stock-$qty;
$query2="UPDATE `tbl_stock` SET `Stock`='$balance' WHERE `Product_id`='$productid'";
mysqli_query($conn,$query2);
$select3="SELECT * FROM tbl_user,tbl_product,tbl_cart WHERE tbl_cart.User_id=tbl_user.Login_id and tbl_cart.Product_id=tbl_product.Product_id and tbl_cart.Cart_id='$cartid'";
$result4= $conn->query($select3);
$row4 = $result4->fetch_assoc();
$pprice=$row4['P_price'];
$total=$qty*$pprice;
include('pdf_mc_table.php');
ob_start ();
$pdf = new PDF_MC_TABLE();
$pdf->AddPage();
$pdf->SetFont('Arial','B',15);  
$pdf->Cell(176, 5, 'Local Shopee', 0, 0, 'C');
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln(); 
$pdf->SetFont('Arial','',12); 
$pdf->Multicell(80,12,'Name : '.$row4['Uname'] ,1);
$pdf->Multicell(80,12,'Address : '.$row4['U_address'].','.$row4['U_houseno'].','.$row4['U_street'].','.$row4['U_pincode'],1);
$pdf->Multicell(80,12,'Product : '.$row4['P_name'],1);
$pdf->Multicell(80,12,'Price  : '.$row4['P_price'],1);
$pdf->Multicell(80,12,'Quantity : '.$qty,1);
$pdf->Multicell(80,12,'Total Price : '.$total,1);

$pdf->Output();
ob_end_flush();


?>