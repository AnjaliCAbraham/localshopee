<?php
 	include('connection.php');
     $sql="";
	 $m=$_POST['Mobile'];
     $e=$_POST['Email'];
     $pwd=$_POST['Password'];
	 echo $m;
	 echo $e;
	 echo $pwd;
     $sql1="select Login_id from tbl_user where U_email='$e' and U_mobile='$m'";
     $sql=mysqli_query($conn,$sql1);
         if ($sql->num_rows>0)
		 {
		    $row =$sql->fetch_assoc();
			$id=$row['Login_id'];
			$sqlu="update tbl_login set Password='$pwd' where Login_id='$id'"; 
            $sql2=mysqli_query($conn,$sqlu);
            header("Location:login.html"); 
 		 }
		  else
		  {
            echo '<script> alert("Account Not FOUND")</script>';
		  }   
 ?>
