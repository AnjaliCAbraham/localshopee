<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Invoice</title>
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
			rel="stylesheet"
		/>
		
	</head>
<?php

$image= 'images/logo.png';
require_once __DIR__ . '/TCPDF-main/tcpdf.php';
$pdf= new TCPDF();
$pdf->AddPage('','A3');
//$pdf->Image($image,80, 30, 25,25);

$html =''
;
$pdf->WriteHTML($html);
ob_end_clean();
$pdf->Output('idcard.pdf','D');
header("location:upload.php");
?>


