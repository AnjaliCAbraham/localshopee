<html>
<head>
<title>connection</title>
</head>
<body>
<?php 
$servername="localhost";
$username="root";
$password="";
$dbname="local_shopee";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn)
{
die("connection failed");
}


?>
</body>
</html>
