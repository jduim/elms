<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{

$userEmail=$_POST['userEmail'];
$password=md5($_POST['password']);
$sql ="SELECT userEmail,password,noic,status FROM user WHERE (noic=:userEmail || userEmail=:userEmail) and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
 foreach ($results as $result) {
 $_SESSION['noic']=$result->noic;
if($result->status==1)
{
$_SESSION['login']=$_POST['userEmail'];
echo "<script type='text/javascript'> document.location ='issue-book.php'; </script>";
} else {
echo "<script>alert('Your Account Has been blocked. Please contact admin');</script>";

}
}

} 

else{
echo "<script>alert('Invalid Email or Password');</script>";
}
}

if(!empty($_POST["remember"])) {
  //COOKIES for username
  setcookie ("user_login",$_POST["userEmail"],time()+ (10 * 365 * 24 * 60 * 60));
  //COOKIES for password
  setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
  } else {
  if(isset($_COOKIE["user_login"])) {
  setcookie ("user_login","");
  if(isset($_COOKIE["userpassword"])) {
  setcookie ("userpassword","");
          }
        }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>ELMS || Login</title>
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
   
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div align="center">
                  <img src="images/picture1.png" width="200" height="100" >
                <br><br>
                <h3 style="font-family:verdana;">UIM Library</h3>
              </div>
                <form class="pt-3" id="login" method="post" name="login">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Email or IC Number" required="true" name="userEmail" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" >
                  </div>
                  <div class="form-group">
                    
                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required="true" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>" autocomplete="current-password" >
                    <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-success btn-block loginbtn" name="login" type="submit">Login</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" id="remember" class="form-check-input" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> /> Keep me signed in </label>
                    </div>
                    <!--a href="forgot-password.php" class="auth-link text-black">Forgot password?</a-->
                  </div>
                  <div class="mb-2">
                  <!--a href="signup.php">Create an account</a-->
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