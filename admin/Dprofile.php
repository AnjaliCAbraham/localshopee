<?php
 include 'connection.php';
 session_start();
 $id=$_SESSION['uid'];
 if(!isset($_SESSION['uid']))
 {
    header("location:logout.php");
 }
 $sql="SELECT * FROM `tbl_deliveryboy`,`tbl_login` WHERE tbl_deliveryboy.Login_id=tbl_login.Login_id and tbl_deliveryboy.Login_id='$id';";			
$result = $connection->query($sql);
while($row = $result->fetch_assoc()) {
    $u=$row['d_name'];
	$m=$row['d_mobile'];
    $e=$row['d_email'];
    $ad=$row['d_address'];
    $h=$row['d_houseno'];
    $s=$row['d_street'];
    $p=$row['d_pincode'];
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
	$sql1=mysqli_query($connection,"UPDATE `tbl_deliveryboy` SET `d_name`='$name',`d_mobile`='$mobileno',`d_email`='$email',`d_address`='$address',`d_houseno`='$houseno',`d_street`='$street',`d_pincode`='$pincode' WHERE `Login_id`='$id'");
	$sql2=mysqli_query($connection,"UPDATE `tbl_login` SET `Username`='$email',`Password`='$password' WHERE `Login_id`='$id'");
	header("Refresh:0; url=Dprofile.php");
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
        <title> Deliveryboy Profile | Local Shopee</title>
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
            <a class="navbar-brand" href="Ddashboard.php">Deliveryboy</a>
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
                           <h6 class="mt-3 f-14 f-w-600"><?php echo $_SESSION['uname1'];?></h6>
                       </div>
                    </header>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="Dprofile.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Edit Profile
                            </a>
                            <a class="nav-link" href="Drequest.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Delivery Request
                            </a>
                            <a class="nav-link" href="accepteddelivery.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                 Accepted Delivery
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
                            Edit Profile
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                            <form method='post' action="Dprofile.php">
                            <div class="form-row">
                            <div class="col-sm-6 col-md-6">

                  <div class="mb-3">
                    <label class="form-label"> Name</label>
                    <input class="form-control" type="text" placeholder="Name"  minlength="3" id="name" name="name" value="<?php echo $u ?>" onkeydown="return alphaOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input class="form-control" type="text" placeholder="Address" minlength="5" id="address" name="address" value="<?php echo $ad ?>" onkeydown="return alphaOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">House No</label>
                    <input class="form-control" type="text" placeholder="House No" id="houseno" name="houseno" value="<?php echo $h ?>" onkeydown="return numOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Street</label>
                    <input class="form-control" type="text" placeholder="Street" name="street" id="street" value="<?php echo $s ?>" onkeydown="return alphaOnly(event);">
                  </div>
                 </div>
                  <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Pincode</label>
                    <input class="form-control" type="text" placeholder="Pincode" id="pincode" minlength='6' maxlength='6' name="pincode" value="<?php echo $p ?>" onkeydown="return numOnly(event);">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input class="form-control" type="text" placeholder="Mobile No:" id="mobileno" minlength="10" maxlength="10" name="mobileno" value="<?php echo $m ?>" onkeydown="return numOnly(event);">
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
                    <input class="form-control" type="password" placeholder="Password" id="password" name="password" value="<?php echo $pwd ?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button class="btn btn-primary" name="submit"  id="submit" type="submit">Update Profile</button>
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








 