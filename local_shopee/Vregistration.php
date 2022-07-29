<html>
<head>
<title>vRegistration</title>
</head>
<body>
	<?php
	include('connection.php');
    $sql="";
	$u=$_POST['Name'];
	$m=$_POST['Mobile'];
    $e=$_POST['Email'];
    $ad=$_POST['Address'];
    $h=$_POST['Houseno'];
    $s=$_POST['Street'];
    $p=$_POST['Pincode'];
    $pwd=$_POST['Password'];
    //$encrypted_pwd = md5($pwd);
    $sql1="insert into tbl_login(Username,Password,Role,Status) values ('$e','$pwd',2,0)";
    $sql=mysqli_query($conn,$sql1);
    $x=mysqli_insert_id($conn);
    $sqlu="insert into tbl_vendor(V_name, V_mobile, V_email, Login_id, V_address, V_houseno, V_street, V_pincode) values ('$u','$m','$e','$x','$ad','$h','$s','$p')"; 
    $sql2=mysqli_query($conn,$sqlu);
    header("Location:../local_shopee/login.html");
   
?>
</body>
</html>