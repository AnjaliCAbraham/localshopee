<?php
 include 'connection.php';
 use PHPMailer\PHPMailer\PHPMailer; 
 use PHPMailer\PHPMailer\Exception;

 session_start();
 $id=$_SESSION['uid'];
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
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
  $fileName=$_FILES["file"]["name"];
	$password=$_POST['password'];
  $targetDir="assets/img/license/$name/";
    mkdir($targetDir);
    $targetFilePath = $targetDir . $fileName; 
    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

	$sql1=mysqli_query($connection,"INSERT INTO `tbl_login`( `Username`, `Password`, `Role`, `Status`) VALUES ('$email','$password','3','1')");
    $x=mysqli_insert_id($connection);
	$sql2=mysqli_query($connection,"INSERT INTO `tbl_deliveryboy`(`d_name`, `d_mobile`, `d_email`, `Login_id`, `d_address`, `d_houseno`, `d_street`, `d_pincode`,`d_license`) VALUES ('$name','$mobileno','$email','$x','$address','$houseno','$street','$pincode','$targetFilePath')");
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
$mail->addReplyTo('reply@localshopee.com', 'Local_shopee'); 
// Add a recipient 
$mail->addAddress($email); 
 
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
<p>Your new account with local shopee is ready please click the activate button below to login to the Deliveryboy page and</p>
Below given is your account details <br>
<table border="1" style="margin-top:30px">
  <tr>
    <th scope="row">Mail From</th>
    <td>Local Shopee</td>
  </tr>
  <tr>
    <th scope="row">Username</th>
    <td>'.$email.'</td>
  </tr>
  <tr>
    <th scope="row">Password</th>
    <td>'.$password.'</td>
  </tr>
</table>
<div style="margin-top:30px">
Explore from here--->> <a href="http://localhost/Project/local_shopee/activate.php?id="'. $x.'>Local Shopee</a></div>
</center>
</body>
</html>'; 
$mail->Body = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    header("Location:../Magezine-main/Vadddeliveryboy.php");
    echo 'Message has been sent.'; 
}   
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> Vendor Profile | Local Shopee</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
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

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="Adashboard.php">Vendor</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                    <header class="main-nav">
                       <div class="sidebar-user text-center">
                           <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="..\local_shopee\images\home\1.png" alt="" />
                              <a href="Vprofile.php"> <h6 class="mt-3 f-14 f-w-600"><?php echo $_SESSION['uname1'];?></h6></a>
                       </div>
                    </header>
                    <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="Vdashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="Vproductdetail.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Product
                            </a>
                            <a class="nav-link" href="Stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock
                            </a>
                            <a class="nav-link" href="Vorder.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Order
                            </a>
                            <a class="nav-link" href="Vdelivery.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Delivery
                            </a>        
                            <a class="nav-link" href="product_upload.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Add Product
                            </a>
                            <a class="nav-link" href="Vadddeliveryboy.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Add Deliveryboy
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                            ADD DELIVERYBOY
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                <form method='post' action="Vadddeliveryboy.php" enctype="multipart/form-data">
                                            <div class="form-row">
                            <div class="col-sm-6 col-md-6">

                  <div class="mb-3">
                    <label class="form-label"> Name</label>
                    <input class="form-control" type="text" placeholder="Name"  minlength="3" id="name" name="name"  onkeydown="return alphaOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input class="form-control" type="text" placeholder="Address" minlength="5" id="address" name="address"  onkeydown="return alphaOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">House No</label>
                    <input class="form-control" type="text" placeholder="House No" id="houseno" name="houseno"  maxlength="3" onkeydown="return numOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Street</label>
                    <input class="form-control" type="text" placeholder="Street" name="street" id="street"  onkeydown="return alphaOnly(event);">
                  </div>
                 </div>
                  <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Pincode</label>
                    <input class="form-control" type="text" placeholder="Pincode" id="pincode" minlength='6' maxlength='6' name="pincode"  onkeydown="return numOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input class="form-control" type="text" placeholder="Mobile No:" id="mobileno" minlength="10" maxlength="10" name="mobileno"  onkeydown="return numOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input class="form-control" type="email" placeholder="Email address" id="email" name="email" >
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Upload License</label>
                    <input type="file" class="form-control" name="file" />
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="password" placeholder="Password" id="password" name="password" >
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button class="btn btn-primary" name="submit"  id="submit" type="submit">Add Delivery Boy</button>
   </div>
                            </div>
                        </div>
                    </div>
</form>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2021 Local Shopee Inc. All rights reserved.</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>

