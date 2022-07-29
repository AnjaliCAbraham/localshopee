<?php
include('connection.php');
session_start();
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
 }
$id=$_GET['id'];
$sql2="SELECT * FROM `tbl_product`,`tbl_cart` WHERE tbl_product.Product_id=tbl_cart.Product_id and tbl_cart.Cart_id='$id'";
$result2= $conn->query($sql2);
if(isset($_POST['cart1']))
{
$qty=$_POST['qty'];
$uid=$_SESSION['uid'];
$sql="UPDATE `tbl_cart` SET `C_Qty`='$qty' WHERE Cart_id='$id'";
$sqlu=mysqli_query($conn,$sql);
 header("Location:../local_shopee/cart.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product details | Local shopee</title>
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
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
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
						 <li><a href="user_home.php">Home</a></li>
						   
						   <li class="dropdown"><a href="#"><?php echo $_SESSION['uname'];?><i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
								    <li><a href="user_profile.php"><i class="fa fa-user"></i>My Profile</a></li>
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
		<form method="Post" action="">
		<div class="container">
			<!-- <div class="row"> -->
				<!-- <div class="col-sm-9 padding-right"> -->
                <h2 class="title text-center"></h2>
				<div>
				<?php
						if ($result2->num_rows > 0) {
                                while($row2 = $result2->fetch_assoc()) {
    
	                                      ?>
				<img align="left" src= "../Magezine-main/<?php echo $row2["P_image"];?>" alt=""width="400" height="400" />
				<h2 align="left" style="color:black"><?php echo $row2["P_name"] ?></h2>
				<h3 align="left" style="color:black">Rs.<?php echo $row2["P_price"] ?></h3>
				<h5 align="left" style="color:black"><?php echo $row2["P_description"] ?></h5>
				<div class="col-sm-6 col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input id="qty" name="qty" min='2' class="form-control" value="<?php echo $row2["C_Qty"] ?>" type="Number" placeholder="Quantity">
                  </div>
                </div>
				
				<div class="col-sm-6 col-md-6"><br>
				<input type="submit" name="cart1" id="cart1" class="btn btn-default add-to-cart" value="ADD TO CART"/> &nbsp;&nbsp;
                <button onclick="window.location.href='payment.php?id=<?php echo $row2['Product_id']; ?>'" type="submit" name="payment" id="payment" class="btn btn-default add-to-cart">BUY NOW</button>
				</div>
                <?php
					}
				}?>
			</div>
		</div>
		</div>
			</form>
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
					<p class="pull-left"> © 2021 local shopee Inc. All rights reserved.</p>
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