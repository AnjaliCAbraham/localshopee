<?php
 include 'connection.php';
$id=$_REQUEST['id'];
$query7 = "SELECT * from `tbl_product` WHERE Product_id='".$id."'"; 
$result5 = mysqli_query($connection, $query7) or die ( mysqli_error());
$row4 = mysqli_fetch_assoc($result5);

  session_start();
  if(!isset($_SESSION['uid']))
  {
     header("location:logout.php");
  }

if(isset($_POST['submit']))
{
    $username="1";
    $name=$_POST["inputName"];
    $category=$_POST["category"];
    $desc=$_POST["description"];
    $fileName=$_FILES["file"]["name"];
    $price=$_POST["price"];
    $availablity="available";
    $targetDir="assets/img/$username/";
    mkdir($targetDir);
    $targetFilePath = $targetDir . $fileName; 
    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
    $sql1="UPDATE `tbl_product` SET `P_name`='$name',`P_description`='$desc',`Category_id`='$category',`P_image`='$targetFilePath',`P_availability`='$availablity',`P_price`='$price' WHERE `Product_id`='$id'";
    mysqli_query($connection,$sql1);
    header("location:Vproductdetail.php");

}
$sql = "SELECT * FROM `tbl_category`";
$result = $connection->query($sql);
        ?>
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Add Category | Local Shopee </title>
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
                            <a class="nav-link" href="addproduct.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Add Product
                            </a>
                            
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</a></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Add Products
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <form method='post' enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Product Name</label>
                                                        <input class="form-control" name="inputName" type="text" placeholder="Enter Category Name" value="<?php echo $row4['P_name'];?>" minlength="3"required onkeydown="return alphaOnly(event);" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Category Name</label>
                                                       
                                                        <select class="form-control" name="category" id="category" >
                                                        <?php
						                                   if ($result->num_rows > 0) {
                                                             while($row = $result->fetch_assoc()) {?>	
                                                           <option value="<?php echo $row["Category_id"]?>"><?php echo $row["C_name"];?></option><?php
                                                             }
                                                            }
                                                           ?>
                                                          
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Upload Image</label>
                                                        <input type="file" class="form-control" name="file" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Product Description</label>
                                                        <input class="form-control" name="description" type="text" placeholder="Enter Description" value="<?php echo $row4['P_description']; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Product Price</label>
                                                        <input class="form-control" name="price" type="text" placeholder="Enter Price " value="<?php echo $row4['P_price']?>"  required  onkeydown="return numOnly(event);" />
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group mt-4 mb-0"><input type="submit" name="submit" class="btn btn-primary btn-block"  value="Update Product"></div>
        
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy;  2021 Local Shopee Inc. All rights reserved</div>
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
