<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}else{
  if(isset($_POST['submit']))
 {
$uid=$_SESSION['noic'];
$fname=$_POST['fname'];
$userEmail=$_POST['userEmail'];
$mobilenumber=$_POST['mobilenumber'];
$nokad=$_POST['nokad'];
$tlahir=$_POST['tlahir'];
$tempatlahir=$_POST['tempatlahir'];
$agama=$_POST['agama'];
$bangsa=$_POST['bangsa'];
$tarafkahwin=$_POST['tarafkahwin'];
$jenisahli=$_POST['jenisahli'];
$pendidikan=$_POST['pendidikan'];
$kursus=$_POST['kursus'];
$jawatan=$_POST['jawatan'];
$sql="update user set fname=:fname,userEmail=:userEmail,mobilenumber=:mobilenumber,nokad=:nokad,tlahir=:tlahir,tempatlahir=:tempatlahir,agama=:agama,
bangsa=:bangsa,tarafkahwin=:tarafkahwin,jenisahli=:jenisahli,pendidikan=:pendidikan,kursus=:kursus,jawatan=:jawatan where noic=:uid";
$query=$dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':userEmail',$userEmail,PDO::PARAM_STR);
$query->bindParam(':mobilenumber',$mobilenumber,PDO::PARAM_STR);
$query->bindParam(':nokad',$nokad,PDO::PARAM_STR);
$query->bindParam(':tlahir',$tlahir,PDO::PARAM_STR);
$query->bindParam(':tempatlahir',$tempatlahir,PDO::PARAM_STR);
$query->bindParam(':agama',$agama,PDO::PARAM_STR);
$query->bindParam(':bangsa',$bangsa,PDO::PARAM_STR);
$query->bindParam(':tarafkahwin',$tarafkahwin,PDO::PARAM_STR);
$query->bindParam(':jenisahli',$jenisahli,PDO::PARAM_STR);
$query->bindParam(':pendidikan',$pendidikan,PDO::PARAM_STR);
$query->bindParam(':kursus',$kursus,PDO::PARAM_STR);
$query->bindParam(':jawatan',$jawatan,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
 echo '<script>alert("Profile has been updated")</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>ELMS || Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/asset2.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css"/>
    <script src=js/agecal.js></script>
    <script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "checkIC.php",
data:'noic='+$("#noic").val(),
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
    $(document).ready(function(){

        $("#tarikhlahir").change(function(){
           var value = $("#tarikhlahir").val();
            var dob = new Date(value);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            if(isNaN(age)) {

            // will set 0 when value will be NaN
             age=0;

            }
            else{
              age=age;
            }
            $('#umur').val(age);

        });

    });
    </script>
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
                    <h4 class="card-title" style="text-align: center;">Personal Information</h4>
                    
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
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group" align="center">
                    <?php $userphoto=$row->userphoto;
                    if($userphoto==""):
                    ?>
                    <img src="userphoto/noimages.png" width="100" height="100" >
                    <?php else:?>
                    <a href="userphoto/<?php  echo htmlentities($row->userphoto);?>" data-lightbox="mygallery"><img src="userphoto/<?php  echo htmlentities($row->userphoto);?>" width="150" height="150"></a>
                    <?php endif;?>
                    <br>
                    <a href="user-photo.php?id=<?php echo $row->id;?>">Upload Photo</a>
                    </div>
                    <div class="form-row"> 
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" style="font-weight:bold;" name="fname" value="<?php  echo htmlentities($row->fname);?>" class="form-control" required='true' readonly>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">IC Number ( without '-' )</label>
                        <input type="text" style="font-weight:bold;" name="noic" value="<?php  echo htmlentities($row->noic);?>"  id="noic" onBlur="userAvailability()"  class="form-control" maxlength="12" required='true' readonly>
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Matric Card Number / Staff Number</label>
                        <input type="text" id="noid" style="font-weight:bold;" name="nokad" value="<?php  echo htmlentities($row->nokad);?>" class="form-control" required='true' readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Birth of Date</label>
                        <input type="date"  id="tarikhlahir" style="font-weight:bold;" name="tlahir" value="<?php  echo htmlentities($row->tlahir);?>" class="form-control" required='true'>
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Place of Birth</label>
                        <input type="text" style="font-weight:bold;" name="tempatlahir" value="<?php  echo htmlentities($row->tempatlahir);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Religion</label>
                        <select  name="agama" class="form-control" required='true'>
                        <option style="font-weight:bold;" value="<?php  echo htmlentities($row->agama);?>"><?php  echo htmlentities($row->agama);?></option>
                        <option >Pilih...</option>
                        <option style="font-weight:bold;">ISLAM</option>
                        <option style="font-weight:bold;">KRISTIAN</option>
                        <option style="font-weight:bold;">BUDDHA</option>
                        <option style="font-weight:bold;">HINDU</option>
                        <option style="font-weight:bold;">LAIN-LAIN</option>
                        </select>
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Race</label>
                        <input type="text" style="font-weight:bold;" name="bangsa" value="<?php  echo htmlentities($row->bangsa);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Marital Status</label>
                        <select  name="tarafkahwin" class="form-control" required='true'>
                        <option value="<?php  echo htmlentities($row->tarafkahwin);?>"><?php  echo htmlentities($row->tarafkahwin);?></option>
                        <option >Option...</option>
                        <option style="font-weight:bold;">SINGLE</option>
                        <option style="font-weight:bold;">MARRIED</option>
                        </select>
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" id="email" style="font-weight:bold;" name="userEmail" value="<?php  echo htmlentities($row->userEmail);?>" class="form-control" required='true' readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Mobile Number</label>
                        <input type="text" style="font-weight:bold;" name="mobilenumber" value="<?php  echo htmlentities($row->mobilenumber);?>" class="form-control" required='true'>
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Type of Member</label>
                        <input type="text" style="font-weight:bold;" name="jenisahli" value="<?php  echo htmlentities($row->jenisahli);?>" class="form-control" required='true' readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Education</label>
                        <select  name="pendidikan" class="form-control">
                        <option value="<?php  echo htmlentities($row->pendidikan);?>"><?php  echo htmlentities($row->pendidikan);?></option>
                        <option >Option...</option>
                        <option style="font-weight:bold;">CERTIFICATE</option>
                        <option style="font-weight:bold;">DIPLOMA</option>
                        <option style="font-weight:bold;">DEGREE</option>
                        <option style="font-weight:bold;">MASTER</option>
                        <option style="font-weight:bold;">PhD</option>
                        <option style="font-weight:bold;">OTHERS</option>
                        </select>
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Course (For Student)</label>
                        <input type="text" style="font-weight:bold;" name="kursus" value="<?php  echo htmlentities($row->kursus);?>" class="form-control">
                      </div>
                      <div class="form-group col-md-6">
                      <label for="exampleInputName1">Designations (For Academic/Administration Staff)</label>
                        <input type="text" style="font-weight:bold;" name="jawatan" value="<?php  echo htmlentities($row->jawatan);?>" class="form-control">
                      </div>
                      </div>
                      <?php } ?>

                      <button type="submit" class="btn btn-primary mr-2" name="submit" id="submit">Save</button>
                     
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
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <script>tarikhlahir.max = new Date().toISOString().split("T")[0];</script>
    <!-- script anti-reload data after refresh -->
    <script>
	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
    <!-- End custom js for this page -->
    <!--script type="text/javascript">
    (function(d, m){
        var kommunicateSettings = 
            {"appId":"2124823db1be2048693c2093a08119866","popupWidget":true,"automaticChatOpenOnNavigation":true};
        var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
        s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
        var h = document.getElementsByTagName("head")[0]; h.appendChild(s);
        window.kommunicate = m; m._globals = kommunicateSettings;
    })(document, window.kommunicate || {});
/* NOTE : Use web server to view HTML files as real-time update will not work if you directly open the HTML file in the browser. */
</script-->
  </body>
</html>
<?php } }?>