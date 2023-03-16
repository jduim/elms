<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['submit']))
  {
$userEmail=$_POST['userEmail'];
$mobilenumber=$_POST['mobilenumber'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT userEmail FROM user WHERE userEmail=:userEmail and mobilenumber=:mobilenumber";
$query= $dbh -> prepare($sql);
$query-> bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
$query-> bindParam(':mobilenumber', $mobilenumber, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update user set password=:newpassword where userEmail=:userEmail and mobilenumber=:mobilenumber";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobilenumber', $mobilenumber, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile Number is invalid');</script>"; 
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>ELMS || Forgot Password</title>
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
   <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
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
                <div class="">
                <img src="images/asset1.png" width="250" >
                </div><br>
                <h4>RECOVER PASSWORD</h4>
                <h6 class="font-weight-light">Enter your email address and mobile number to reset password!</h6>
                <form class="pt-3" id="login" method="post" name="login">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" placeholder="Email Address" required="true" name="userEmail">
                  </div>
                  <div class="form-group">
                    
                     <input type="text" class="form-control form-control-lg"  name="mobilenumber" placeholder="Mobile Number" required="true">
                  </div>
                  <div class="form-group">
                   
                    <input class="form-control form-control-lg" type="password" name="newpassword" placeholder="New Password" required="true"/>
                  </div>
                  <div class="form-group">
                    
                   <input class="form-control form-control-lg" type="password" name="confirmpassword" placeholder="Confirm Password" required="true" />
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-success btn-block loginbtn" name="submit" type="submit">Reset</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                  </div>
                  <div class="mb-2">
                    <a href="index.php" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="icon-social-home mr-2"></i>Back to Login </a>
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
    <!-- endinject -->
  </body>
</html>