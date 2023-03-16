<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login'])==0) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
$uid=$_SESSION['noic'];
$userphoto=$_FILES["userphoto"]["name"];
$extension = substr($userphoto,strlen($userphoto)-4,strlen($userphoto));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Profile photo has invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$userphoto=md5($userphoto).time().$extension;
 move_uploaded_file($_FILES["userphoto"]["tmp_name"],"userphoto/".$userphoto);

 $sql="update user set userphoto=:userphoto where noic=:uid ";

$query = $dbh->prepare($sql);
$query->bindParam(':userphoto',$userphoto,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
echo '<script>alert("Profile photo has been updated")</script>';
echo "<script>window.location.href='profile.php'</script>";

  }
}
  }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>ELMS | User Photo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/asset2.png"/>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->
   
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Upload Photo</h4>
                   
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <?php
                    $uid= $_SESSION['noic'];
                    $sql="SELECT * from user where noic=:uid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $row)
                    {               ?>
                    <div class="form-group">
                       <label for="exampleInputUsername1">Full Name</label>
                      <input id="fname" name="fname" type="text" class="form-control" readonly="true" value="<?php  echo $row->fname;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Upload Photo</label>
                      <input id="userphoto" name="userphoto" type="file" class="form-control" required="true" value="">
                      <span style="font-size:12px; color:red">(Maximum of photo 10 MB only)</span>
                    </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Save</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
  <?php } ?>