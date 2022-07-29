<?php
include('connection.php');
session_start();
$uid=$_SESSION['uid'];
 $au=mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE Login_id=$uid");
	        $row=mysqli_fetch_array($au);
            $pincode=$row['U_pincode'];
$sql="SELECT * FROM `tbl_category`";			
$result = $conn->query($sql);
$sql2="SELECT * FROM `tbl_vendor`,tbl_product,tbl_user where tbl_product.Vendor_id=tbl_vendor.Vendor_id and tbl_user.U_pincode=tbl_vendor.V_pincode and tbl_user.U_pincode='$pincode' and tbl_product.Category_id='4'";
$result2= $conn->query($sql2);
$sql3="SELECT * FROM `tbl_category`";			
$result3 = $conn->query($sql3);
$sql4="SELECT * FROM `tbl_category`";			
$result4 = $conn->query($sql4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Local shopee</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
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
		
			<!-- <div class="row"> -->
				<!-- <div class="col-sm-9 padding-right"> -->
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Furnitures</h2>
						<?php
						if ($result2->num_rows > 0) {
                                while($row2 = $result2->fetch_assoc()) {
    
	                                      ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src= "../Magezine-main/<?php echo $row2["P_image"];?>" alt=""width="150" height="300" />
                                            <h2 style="color:black"><?php echo $row2["P_name"] ?></h2>
											<h2 style="color:black">Rs.<?php echo $row2["P_price"] ?></h2>
											<a href="wishlistinsert.php?id=<?php echo $row2['Product_id']; ?>" class="btn btn-default add-to-cart">Wishlist</a>
											<a href="productdetails.php?id=<?php echo $row2['Product_id']; ?>" class="btn btn-default add-to-cart">Details</a>
										</div>
										</div>
								<div class="choose">
									
								</div>
							</div>
						</div>
						<?php
                            }
                         }
						?>
						
					</div><!--features_items-->
					
					
				</div>
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