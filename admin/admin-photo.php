<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['elmsaid'])==0)
  { 
header('location:index.php');
}
else{ 
  if(isset($_POST['submit']))
  {
$adminid=$_SESSION['elmsaid'];
$gambaradmin=$_FILES["gambaradmin"]["name"];
$extension = substr($gambaradmin,strlen($gambaradmin)-4,strlen($gambaradmin));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Profile photo has invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$gambaradmin=md5($gambaradmin).time().$extension;
 move_uploaded_file($_FILES["gambaradmin"]["tmp_name"],"adminphoto/".$gambaradmin);

 $sql="update tbladmin set gambaradmin=:gambaradmin where id=:aid";

$query = $dbh->prepare($sql);
$query->bindParam(':gambaradmin',$gambaradmin,PDO::PARAM_STR);
$query->bindParam(':aid',$adminid,PDO::PARAM_STR);
$query->execute();
echo '<script>alert("Profile photo has been updated")</script>';
echo "<script>window.location.href='admin-profile.php'</script>";

  }
}
    ?>
<!DOCTYPE html>
<html>
<head>
 
  <title>ELMS | Admin Photo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../images/asset2.png"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <?php include_once('includes/header.php');?>

 
<?php include_once('includes/sidebar.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Admin Photo</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <h4 style="text-align: center;">ADMIN PHOTO</h4>
            <form class="forms-sample" method="post" enctype="multipart/form-data">
            <?php
         $aid= $_SESSION['elmsaid'];
$sql="SELECT * from tbladmin where id=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                    <div class="form-group">
                       <label for="exampleInputUsername1">Full Name</label>
                      <input id="fname" name="fname" type="text" class="form-control" readonly="true" value="<?php  echo $row->namapenuh;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Upload Photo</label>
                      <input id="gambaradmin" name="gambaradmin" type="file" class="form-control" required="true" value="">
                      <span style="font-size:12px; color:red">(Maximum of photo 10 MB only)</span>
                    </div>
                    <?php $cnt=$cnt+1;}} ?>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Save</button>
                  </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include_once('includes/footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
<?php }  ?>