<?php
include('connection.php');
session_start();
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
 }
 $loginid=$_SESSION['uid'];
$sql="SELECT * ,tbl_product.P_price*tbl_cart.C_Qty as Total_Price FROM tbl_product,tbl_cart where tbl_product.Product_id=tbl_cart.Product_id and tbl_cart.User_id='$loginid' and tbl_cart.status='Added'";			
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
    $date=  date("Y/m/d");
    $cartid=$row['Cart_id'];
    echo $cartid;
    echo 'ad';
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
}
$sql5="SELECT * ,tbl_product.P_price*tbl_cart.C_Qty as Total_Price FROM tbl_product,tbl_cart where tbl_product.Product_id=tbl_cart.Product_id and tbl_cart.User_id='$loginid' and tbl_cart.status='Added'";			
$result5 = $conn->query($sql5);
while($row5 = $result5->fetch_assoc())
{
    $date=  date("Y/m/d");
    $cartid=$row5['Cart_id'];
    $totalprice=$row5['Total_Price'];
    $query1="INSERT INTO `tbl_payment`(`Cart_id`, `Date`, `Payment`) VALUES ('$cartid','$totalprice','Success')";
    mysqli_query($conn,$query1);
}
$sql6="SELECT * ,tbl_product.P_price*tbl_cart.C_Qty as Total_Price FROM tbl_product,tbl_cart where tbl_product.Product_id=tbl_cart.Product_id and tbl_cart.User_id='$loginid' and tbl_cart.status='Added'";			
$result6 = $conn->query($sql5);
while($row6 = $result6->fetch_assoc())
{
    $cartid=$row6['Cart_id'];
    $totalprice=$row5['Total_Price'];
    $query6="UPDATE `tbl_cart` SET `Status`='Ordered' WHERE `Cart_id`='$cartid'";
    mysqli_query($conn,$query6);
    
}
$select3="SELECT * FROM tbl_user,tbl_product,tbl_cart WHERE tbl_cart.User_id=tbl_user.Login_id and tbl_cart.Product_id=tbl_product.Product_id and tbl_cart.Status='ordered' and tbl_cart.User_id='3'";
$result4= $conn->query($select3);
$row4 = $result4->fetch_assoc();

include('pdf_mc_table.php');
ob_start ();
$pdf = new PDF_MC_TABLE();
$pdf->AddPage();
$pdf->SetFont('Arial','B',15);  
$pdf->Cell(176, 5, 'Order  Details', 0, 0, 'C');

  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln(); 
$pdf->SetFont('Arial','',12); 
$pdf->Multicell(80,12,'Name : '.$row4['Uname'] ,1);
$pdf->Multicell(80,12,'Address : '.$row4['U_address'].','.$row4['U_houseno'].','.$row4['U_street'].','.$row4['U_pincode'],1);
$select4="SELECT * FROM tbl_user,tbl_product,tbl_cart WHERE tbl_cart.User_id=tbl_user.Login_id and tbl_cart.Product_id=tbl_product.Product_id and tbl_cart.Status='ordered' and tbl_cart.User_id='3'";
$result5= $conn->query($select4);
while($row5 = $result5->fetch_assoc())
{
    $pprice=$row5['P_price'];
    $qty=$row5['C_Qty'];
$total=$qty*$pprice;
$pdf->Multicell(80,12,'Product : '.$row5['P_name'],1);
$pdf->Multicell(80,12,'Price  : '.$row5['P_price'],1);
$pdf->Multicell(80,12,'Quantity : '.$row5['C_Qty'],1);
$pdf->Multicell(80,12,'Total Price : '.$total,1);
}
$select5="SELECT sum(P_price*C_Qty) as grandtotal FROM tbl_user,tbl_product,tbl_cart WHERE tbl_cart.User_id=tbl_user.Login_id and tbl_cart.Product_id=tbl_product.Product_id and tbl_cart.Status='ordered' and tbl_cart.User_id='3'";
$result6= $conn->query($select5);
$row6 = $result6->fetch_assoc();

$pdf->Multicell(80,12,'Grand Total : '.$row6['grandtotal'],1);

$pdf->Output();
ob_end_flush();


?>