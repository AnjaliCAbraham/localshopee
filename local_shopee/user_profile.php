<?php
include('connection.php');
session_start();
$id=$_SESSION['uid'];
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
 }
$sql="SELECT * FROM `tbl_user`,`tbl_login` WHERE tbl_user.Login_id=tbl_login.Login_id and tbl_user.Login_id='$id'";			
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $u=$row['Uname'];
	$m=$row['U_mobile'];
    $e=$row['U_email'];
    $ad=$row['U_address'];
    $h=$row['U_houseno'];
    $s=$row['U_street'];
    $p=$row['U_pincode'];
    $pwd=$row['Password'];
  }
  if(isset($_POST['submit']))
  {
	$name=$_POST['name'];
	$address=$_POST['address'];
	$houseno=$_POST['houseno'];
	$pincode=$_POST['pincode'];
	$street=$_POST['street'];
	$mobileno=$_POST['mobileno'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql1=mysqli_query($conn,"UPDATE `tbl_user` SET `Uname`='$name',`U_mobile`='$mobileno',`U_email`='$email',`U_address`='$address',`U_houseno`='$houseno',`U_street`='$street',`U_pincode`='$pincode' WHERE Login_id='$id'");
	$sql2=mysqli_query($conn,"UPDATE `tbl_login` SET `Username`='$email',`Password`='$password' WHERE `Login_id`='$id'");
	header("Refresh:0; url=user_profile.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Profile | Local shopee</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<script type="text/javascript"> 
function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key == 32);
};
function numOnly(event) {
  var key = event.keyCode;
  return ((key >= 48 && key <= 57) || key == 8);
};
function pclear(){
  document.getElementById('res3').innerHTML = '';
  return true;
};
</script>

</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +91 8289982311</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@localshopee.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
						 <ul class="nav navbar-nav">
						   <li class="dropdown"><a href="#"><?php echo $_SESSION['uname'];?><i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
									<li><a href="wishlist.php"><i class="fa fa-star"></i> Wishlist</a></li>
								    <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								    <li><a href="index.php"><i class="fa fa-lock"></i> Logout</a></li>
										
                                </ul>
                            </li> 
                          </ul>	
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
					</div>
					<div class="col-sm-3">
						
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	
	<section>
    <div class="container">
    <div class="col-xl-8">
          <form class="card" method="post" action="">
            <div class="card-header pb-0">
              <h4 class="card-title mb-0">Edit Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
             
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label"> Name</label>
                    <input class="form-control" type="text" placeholder="Name" id="name"  name="name" minilength='3' onkeydown="return alphaOnly(event);" required value="<?php echo $u ?>" >
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input class="form-control" type="text" placeholder="Address" name="address" id="address" value="<?php echo $ad ?>" onkeydown="return alphaOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">House No</label>
                    <input class="form-control" type="text" placeholder="House No" id="houseno" name="houseno" value="<?php echo $h ?>" required  onkeydown="return numOnly(event);" >
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Street</label>
                    <input class="form-control" type="text" placeholder="Street" id="street" name="street" value="<?php echo $s ?>"  onkeydown="return alphaOnly(event);" >
                  </div>
                 </div>
                  <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Pincode</label>
                    <input class="form-control" type="text" placeholder="Pincode" id="pincode" name="pincode" minlength='6' maxlength='6' value="<?php echo $p ?>" required  onkeydown="return numOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input class="form-control" type="text" placeholder="Mobile No:" id="mobileno" name="mobileno" minlength='10' maxlength='10' value="<?php echo $m ?>" required  onkeydown="return numOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input class="form-control" type="email" placeholder="Email address" id="email" name="email" value="<?php echo $e ?>">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="password" placeholder="Password" name="password" name="password" value="<?php echo $pwd ?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button class="btn btn-primary" type="submit" name="submit" id="submit">Update Profile</button>
            </div>
          </form>
        </div>
    </div>							
</section>
	
	<footer id="footer"  style="margin-top:50px"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>local</span>-shopee</h2>
							</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">About Us</a></li>
								<li><a href="">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Categories</h2>
							<ul class="nav nav-pills nav-stacked">
							    <li><a href="Appliances.php">Appliances</a></li>
							    <li><a href="Beauty.php">Beauty</a></li>
								<li><a href="Electronics.php">Electronics</a></li>
								<li><a href="Furniture.php">Furniture</a></li>
								<li><a href="Grocery.php">Grocery</a></li>
								<li><a href="Mobile.php">Mobiles</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privacy Policy</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Social</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Facebook</a></li>
								<li><a href="">Twitter</a></li>
								
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2021 local shopee Inc. All rights reserved.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>