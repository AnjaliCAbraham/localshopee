<head>
    <?php
    include('connection.php');
    session_start();
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
 }
 $loginid=$_SESSION['uid'];
    $cartid=$_GET['id'];
    $sql="SELECT * FROM `tbl_cart` WHERE Cart_id = $cartid";
    $result = $conn->query($sql) or die($conn->error);
    $row4 = $result->fetch_assoc();
    $product=$row4['Product_id'];
    $qty=$row4['C_Qty'];
    $sql1="SELECT * FROM `tbl_product` WHERE Product_id=  $product";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $productprice=$row1['P_price'];
    $total=$productprice * $qty;

    

    ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
			integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<div class="container mt-5">
</div>
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
				<img align="left" src= "../Magezine-main/<?php echo $row1["P_image"];?>" alt=""width="400" height="400" />
				<h2 align="left" style="color:black"><?php echo $row1["P_name"] ?></h2>
				<h3 align="left" style="color:black">Rs.<?php echo $row1["P_price"] ?></h3>
				<h5 align="left" style="color:black"><?php echo $row1["P_description"] ?></h5>
				<div class="col-sm-6 col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <h5 align="left" style="color:black"><?php echo $row4['C_Qty']; ?></h5>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Total Price</label>
                    <h5 align="left" style="color:black"><?php echo $total; ?></h5>
                  </div>
                </div>
				
				<div class="col-sm-6 col-md-6"><br>
                <form>
    <input type="hidden" class="form-control" name="amount" placeholder="Enter Amount" id="amount" value="<?php echo $total?>"required>
	<br><input type="hidden" class="form-control" name="cartid" placeholder="Enter Amount" id="cartid" value="<?php echo $cartid ?>"required>
    <input type="button" name="button" class="btn btn-success btn-lg btn-block" value="Pay Now" onclick="MakePayement()">
</form>
				</div>
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
<script>
    function MakePayement(){
        var cartid = $("#cartid").val();
        var amount = $("#amount").val();
        var options = {
    "key": "rzp_test_BjwvxxcsaUyjEi", // Enter the Key ID generated from the Dashboard
    "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name":name,
    "description": "Local Shopee",
    "image": "data:image/jpeg;base64,/9j/4AAQSkZJRgAB",
    //"order_id": "order_DaZlswtdcn9UNV", //Pass the `id` obtained in the previous step
    //"account_id": "acc_GRWKk7qQsLnDjX",
    "handler": function (response){
        jQuery.ajax({
            type:"POST",
            url:"paymentdone.php",
            data:"pay_id="+response.razorpay_payment_id+"&amount="+amount+"&cartid="+cartid,
            success:function(result){
                window.location.href="success.php?cartid=<?php echo $cartid;?>";
            }
        });
    }
};
var rzp1 = new Razorpay(options);
    rzp1.open();
    
}
    
</script>
