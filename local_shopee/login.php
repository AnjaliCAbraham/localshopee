
	<?php
	include('connection.php');
    
	$u=$_POST['uname'];
	$p=$_POST['pswd'];
   // $encrypted_pwd = md5($p);
	$a=mysqli_query($conn,"SELECT * FROM tbl_login where Username ='$u' and Password ='$p'");
	$row=mysqli_fetch_array($a);
    $Status= $row['Status'];
	$uid=$row['Login_id'];
    if(!empty($row))
	{
		if($row['Role']==1)
		{
			session_start();
			$_SESSION['uid']=$uid;
			$au=mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE Login_id=$uid");
	        $row=mysqli_fetch_array($au);
            $_SESSION['uname']=$row['Uname'];
            if( $Status == 1)  
            {
             header("Location:user_home.php");   
            }
            elseif( $Status == 0)  
            {
             header("Location:../local_shopee/login.html");   
            }
        
		}
		else if($row['Role']==2)
		{
			session_start();
			$_SESSION['uid']=$uid;
            
            if( $Status == 1)  
            {
				$_SESSION['uid']=$uid;
			$au=mysqli_query($conn,"SELECT * FROM `tbl_vendor` WHERE Login_id=$uid");
	        $row=mysqli_fetch_array($au);
            $_SESSION['uname1']=$row['V_name'];
             header("Location:../Magezine-main/Vdashboard.php");   
            }
            elseif( $Status == 0)  
            {
             header("Location:login.html");   
            }
			
		}	
		else if($row['Role']==3)
		{
			session_start();
			$_SESSION['uid']=$uid;
            
            if( $Status == 1)  
            {
				$_SESSION['uid']=$uid;
			$au=mysqli_query($conn,"SELECT * FROM `tbl_deliveryboy` WHERE Login_id=$uid");
	        $row=mysqli_fetch_array($au);
            $_SESSION['uname1']=$row['d_name'];
             header("Location:../Magezine-main/Ddashboard.php");   
            }
            elseif( $Status == 0)  
            {
             header("Location:login.html");   
            }
			
		}	
		
		else
		{	
			if($row['Role']==0)
		{
		
			session_start();
			$_SESSION['uid']=$uid;
            header("Location:../Magezine-main/Adashboard.php");   
         }
		else
			{
				header("Location:login.php?error=Invalid Username/Password!!</center>"); 
	
			}
		}
	}
	else
		header("Location:login.php?error=Invalid Username/Password!!</center>"); 
	

		
?>
