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
      $namapenuh=$_POST['namapenuh'];
      $staffno=$_POST['staffno'];
      $email=$_POST['email'];
      $notelefon=$_POST['notelefon'];
      $password=md5($_POST['password']);
      $sql="update tbladmin set namapenuh=:namapenuh,staffno=:staffno,email=:email,notelefon=:notelefon,password=:password where id=:aid";
       $query = $dbh->prepare($sql);
       $query->bindParam(':namapenuh',$namapenuh,PDO::PARAM_STR);
       $query->bindParam(':staffno',$staffno,PDO::PARAM_STR);
       $query->bindParam(':email',$email,PDO::PARAM_STR);
       $query->bindParam(':notelefon',$notelefon,PDO::PARAM_STR);
       $query->bindParam(':password',$password,PDO::PARAM_STR);
       $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
  $query->execute();
  
      echo '<script>alert("Profile has been updated")</script>';
  
    }
    ?>
<!DOCTYPE html>
<html>
<head>
 
  <title>ELMS | Admin Profile</title>
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
              <li class="breadcrumb-item active">Admin Profile</li>
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
            <h4 style="text-align: center;">ADMIN PROFILE</h4>
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
<div class="form-group" align="center">
                    <?php $gambaradmin=$row->gambaradmin;
                    if($gambaradmin==""):
                    ?>
                    <img src="adminphoto/noimages.png" width="100" height="100" >
                    <?php else:?>
                    <a href="adminphoto/<?php  echo htmlentities($row->gambaradmin);?>" data-lightbox="mygallery"><img src="adminphoto/<?php  echo htmlentities($row->gambaradmin);?>" width="150" height="150"></a>
                    <?php endif;?>
                    <br>
                    <a href="admin-photo.php?id=<?php echo $row->id;?>">Upload Photo</a>
                    </div>
                    <br>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" name="namapenuh" style="font-weight:bold;" value="<?php echo $row->namapenuh;?>" class="form-control">
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Username</label>
                        <input type="text" name="username" style="font-weight:bold;" value="<?php echo $row->username;?>" class="form-control" readonly>
                      </div>
                      </div>
                      <div class="row">
                      <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Staff Number</label>
                        <input type="text" name="staffno" style="font-weight:bold;" value="<?php echo $row->staffno;?>" class="form-control">
                      </div>
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Mobile Number</label>
                        <input type="text" name="notelefon" style="font-weight:bold;" value="<?php echo $row->notelefon;?>" class="form-control">
                      </div>
                      </div>
                      <div class="row">
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Email</label>
                        <input type="text" name="email" style="font-weight:bold;" value="<?php echo $row->email;?>"   class="form-control">
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Password</label>
                        <input type="password" name="password" style="font-weight:bold;" value=""   class="form-control">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit" id="submit">Save</button>
                    </form>
                    <?php $cnt=$cnt+1;}} ?>

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