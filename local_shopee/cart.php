<?php
include('connection.php');
session_start();
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
 }
 $loginid=$_SESSION['uid'];
$sql="SELECT * ,tbl_product.P_price*tbl_cart.C_Qty as Total_Price FROM tbl_product,tbl_cart where tbl_product.Product_id=tbl_cart.Product_id and tbl_cart.User_id='$loginid' and tbl_cart.status='Added'";			
$result = $conn->query($sql);
$sql1="SELECT SUM(tbl_product.P_price*tbl_cart.C_Qty)as sum FROM tbl_product,tbl_cart where tbl_product.Product_id=tbl_cart.Product_id and tbl_cart.User_id='$loginid' and tbl_cart.status='Added'";			
$result1 = $conn->query($sql1);
$row1 = mysqli_fetch_assoc($result1);
$granttotal=$row1['sum'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | Local shopee</title>
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
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="cart.php" class="active">Cart</a></li>
							</ul>
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
    <table>
  <tr>
    <th>Product Name</th>
    <th>Product Description</th>
    <th>Quantity</th>
    <th>Image</th>
    <th>Price</th>
	<th>Total Price</th>
    <th>Details</th>
	<th>Remove</th>
    <th>Buy Now</th>

  </tr>
  <?php
  while($row = mysqli_fetch_assoc($result))
  {?>
<tr>
  <td><?php echo $row['P_name'] ;?></td>
  <td><?php echo $row['P_description']; ?></td>
  <td><button type="submit" name="add" onclick="location.href='qtyplus.php?id=<?php echo $row['Cart_id']; ?>'">+</button><?php echo $row['C_Qty']; ?><button type="submit" name="minus"onclick="location.href='qtyminus.php?id=<?php echo $row['Cart_id']; ?>'">-</button></td>
  <td><img src="../Magezine-main/<?php echo $row['P_image'];?>"alt=""width="65" height="70" /></td>
  <td><?php echo $row['P_price']; ?></td>
  <td><?php echo $row['Total_Price']; ?></td>
  <td><button class="btn btn-primary" onclick="location.href='productdetails2.php?id=<?php echo $row['Cart_id']; ?>'" type="button">Details</button></td>
  <td><button class="btn btn-primary" onclick="location.href='cartremove.php?id=<?php echo $row['Cart_id']; ?>'" type="button">Remove</button></td>
  <td><button class="btn btn-primary" onclick="location.href='payment.php?id=<?php echo $row['Cart_id']; ?>'" type="button">Buy Now</button></td>
  
  </tr>

   <?php
   }
 ?>
 
<tr>
<td></td>	
<td></td>	
<td></td>	
<td></td>	
 <td>Grand total</td>
  <td><?php echo $granttotal;?></td>
  <td><button class="btn btn-primary" onclick="MakePayement()" type="button">Buy Now</button></td>
</tr>
 
 </table>
 <input type="hidden" class="form-control" name="amount" placeholder="Enter Amount" id="amount" value="<?php echo $granttotal?>"required>
				<!-- <div class="col-sm-9 padding-right"> -->				
				</div>
			</div>
		</div>
	</section>
	<script>
    function MakePayement(){
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
            url:"paymentdone2.php",
            data:"pay_id="+response.razorpay_payment_id,
            success:function(result){
                window.location.href="cart.php";
            }
        });
    }
};
var rzp1 = new Razorpay(options);
    rzp1.open();
    
}
    
</script>

	
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
