<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{

$fname=$_POST['fname'];
$userEmail=$_POST['userEmail'];
$noic=$_POST['noic'];
$mobilenumber=$_POST['mobilenumber']; 
$password=md5($_POST['password']); 
$status=1;
$sql="INSERT INTO  user(fname,userEmail,noic,mobilenumber,password,status) VALUES(:fname,:userEmail,:noic,:mobilenumber,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':userEmail',$userEmail,PDO::PARAM_STR);
$query->bindParam(':noic',$noic,PDO::PARAM_STR);
$query->bindParam(':mobilenumber',$mobilenumber,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Your Registration successfull")</script>';
echo "<script type='text/javascript'> document.location ='index.php'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>ELMS || Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/asset2.png"/>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css">
<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "checkemail.php",
data:'userEmail='+$("#userEmail").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script>
function userAvailabilityIC() {
$("#loaderIcon").show();
jQuery.ajax({
url: "checkIC.php",
data:'noic='+$("#noic").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div align="center">
                <img src="images/asset1.png" width="250" >
                <br>
                <h4 style="font-family:verdana;">UIM Library</h4>
                </div><br>
                <h6 class="font-weight-light">Create an Account</h6>
                <form class="pt-3" id="signup" method="post">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Full Name" required="true" name="fname" >
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Email" required="true" name="userEmail" id="userEmail" onBlur="userAvailability()">
                    <span id="user-availability-status1" style="font-size:12px;"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="IC Number" required="true" name="noic" id="noic" onBlur="userAvailabilityIC()">
                    <span id="user-availability-status" style="font-size:12px;"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Mobile Number" required="true" name="mobilenumber">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required="true">
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-danger btn-block loginbtn" name="signup" type="submit" id="submit">Register</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    
                    <a href="index.php" class="auth-link text-black">Already have an account? Sign in</a>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- script anti-reload data after refresh -->
    <script>
	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
    <!-- endinject -->
  </body>
</html>