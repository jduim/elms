<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>ELMS | Issue Book</title>
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
          <h4 class="card-title">Borrowed Book History</h4>
            <div class="row purchace-popup">
              <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>ISBN</th>
                                            <th>Issued Date</th>
                                            <th>Return Date</th>
                                            <th>Note (Returning book before or on)</th>
                                            <th>Fine (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
$uid=$_SESSION['noic'];
$sql="SELECT tblbook.title,tblbook.isbn,tblissuedbook.issuesdate,tblissuedbook.returndate,tblissuedbook.note,
tblissuedbook.id as rid,tblissuedbook.fine from  tblissuedbook join user on
user.noic=tblissuedbook.noic join tblbook on tblbook.id=tblissuedbook.bookid where 
user.noic=:uid order by tblissuedbook.returndate asc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>   
                      
                                        <tr class="odd gradeX">
                                            <td class="center" style="font-weight:bold;"><?php echo htmlentities($cnt);?></td>
                                            <td class="center" style="font-weight:bold;"><?php echo htmlentities($result->title);?></td>
                                            <td class="center" style="font-weight:bold;"><?php echo htmlentities($result->isbn);?></td>
                                            <td class="center" style="font-weight:bold;"><?php echo htmlentities($result->issuesdate);?></td>
                                            <td class="center" style="font-weight:bold;"><?php if($result->returndate=="")
                                            {?>
                                            <span style="color:red">
                                             <?php   echo htmlentities("Not Return Yet"); ?>
                                                </span>
                                            <?php } else {
                                            echo htmlentities($result->returndate);
                                        }
                                            ?></td>
                                            <td class="center" style="font-weight:bold;"><?php echo htmlentities($result->note);?></td>
                                            <td class="center" style="font-weight:bold;"><?php echo htmlentities($result->fine);?></td>
                                         
                                        </tr>
                                        <?php $cnt=$cnt+1;}} ?>   
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
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
