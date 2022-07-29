<?php
 	include('connection.php');
	 use PHPMailer\PHPMailer\PHPMailer; 
	 use PHPMailer\PHPMailer\Exception;
     $sql="";
	 $m=$_POST['Mobile'];
     $e=$_POST['Email'];
	 echo $m;
	 echo $e;
	 echo $pwd;
     $sql1="select Login_id from tbl_user where U_email='$e' and U_mobile='$m'";
     $sql=mysqli_query($conn,$sql1);
         if ($sql->num_rows>0)
		 {
			require 'PHPMailer/Exception.php'; 
            require 'PHPMailer/PHPMailer.php'; 
            require 'PHPMailer/SMTP.php'; 
			$mail = new PHPMailer; 
 
			$mail->isSMTP();                      // Set mailer to use SMTP 
			$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
			$mail->SMTPAuth = true;               // Enable SMTP authentication 
			$mail->Username = 'localshopee2021@gmail.com';   // SMTP username 
			$mail->Password = 'cvjrufgccldhdwql';   // SMTP password 
			$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
			$mail->Port = 587;                    // TCP port to connect to 
			 
			// Sender info 
			$mail->setFrom('sender@localshopee.com', 'Local_Shopee'); 
			$mail->addReplyTo('reply@localshopee.com', 'Local_Shopee'); 
			// Add a recipient 
			$mail->addAddress($e); 
			 
			//$mail->addCC('cc@example.com'); 
			//$mail->addBCC('bcc@example.com'); 
			 
			// Set email format to HTML 
			$mail->isHTML(true); 
			 
			// Mail subject 
			$mail->Subject = 'Email from localshopee'; 
			 
			// Mail body content 
			$bodyContent .= '<html>
			<head>
			<meta charset="utf-8">
			</head>
			
			<body background="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4hVvyxHSVWVWGu8Uqq1bOi0x7KAhUG22svA&usqp=CAU" style="background-size: cover;">
			<center>
			<h1 style="margin-top: 50px;">Welcome to <b style="color:crimson;">Local Shopee</b></h1>
			<p>Hai,</p>
			<p></p>
			Below given is the link for password reset  <br>
			<div style="margin-top:30px">
			Explore from here--->> <a href="http://localhost/Project/Project/local_shopee/forget.html">Local Shopee</a></div>
			</center>
			</body>
			</html>'; 
			$mail->Body    = $bodyContent; 
			 
			// Send email 
			if(!$mail->send()) { 
				echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
			} else { 
				header("Location:../local_shopee/login.html");
				echo 'Message has been sent.'; 
			}   
 		 }
		  else
		  {
            echo '<script> alert("Account Not FOUND")</script>';
		  }   
 ?>
