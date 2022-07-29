<?php
include('connection.php');
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