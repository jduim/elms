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
      $uid=$_GET['id'];
      $statusAcc=$_POST['statusAcc'];
      $sql="update user set statusAcc=:statusAcc where id=:uid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':statusAcc',$statusAcc,PDO::PARAM_STR);
      $query->bindParam(':uid',$uid,PDO::PARAM_STR);
      $query->execute();
      echo '<script>alert("Account has been verified")</script>';
    }
    ?>
<!DOCTYPE html>
<html>
<head>
 
  <title>ELMS | Librarian Information</title>
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
            <h1>Librarian Information</h1><br>
            <a href="#" onClick="window.print()"><i class="nav-icon fas fa-print"></i></a>
          </div>
          <style>
@media print {
   .noprint {
      visibility: hidden;
   }
}
</style>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Librarian Information</li>
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
            <h4 style="text-align: center;">PERSONAL INFORMATION</h4>
            <form class="forms-sample" method="post" enctype="multipart/form-data" id="example1">
            <?php
$uid=$_GET['id'];
$sql="SELECT * from user where id=$uid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                     <div class="form-group">
                    <?php $userphoto=$row->userphoto;
                    if($userphoto==""):
                    ?>
                    <img src="../userphoto/noimages.png" width="100" height="100" >
                    <?php else:?>
                    <a href="../userphoto/<?php echo $row->userphoto;?>" data-lightbox="mygallery"><img src="../userphoto/<?php echo $row->userphoto;?>" width="150" height="150"></a>
                    <?php endif;?>
                    <br>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" name="fname" style="font-weight:bold;" value="<?php echo $row->fname;?>" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Type of Member</label>
                        <input type="text" name="jenisahli" style="font-weight:bold;" value="<?php echo $row->jenisahli;?>" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Mobile Number</label>
                        <input type="text" name="mobilenumber" style="font-weight:bold;" value="<?php echo $row->mobilenumber;?>" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">IC Number</label>
                        <input type="text" name="noic" style="font-weight:bold;" value="<?php echo $row->noic;?>"   class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Matric Card Number / Staff Number</label>
                        <input type="text" name="nokad" style="font-weight:bold;" value="<?php echo $row->nokad;?>" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Date of Birth</label>
                        <input type="text" name="tlahir" style="font-weight:bold;" value="<?php echo $row->tlahir;?>"   class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6">
                      <label for="exampleInputName1">Religion</label>
                        <input type="text" name="bangsa" style="font-weight:bold;" value="<?php echo $row->agama;?>"   class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Place of Birth</label>
                        <input type="text" name="tempatlahir" style="font-weight:bold;" value="<?php echo $row->tempatlahir;?>" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Race</label>
                        <input type="text" name="bangsa" style="font-weight:bold;" value="<?php echo $row->bangsa;?>"   class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Marital Status</label>
                        <input type="text" name="tarafkahwin" style="font-weight:bold;" value="<?php echo $row->tarafkahwin;?>" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Level of Education</label>
                        <input type="text" name="pendidikan" style="font-weight:bold;" value="<?php echo $row->pendidikan;?>" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Email</label>
                        <input type="text" name="userEmail" style="font-weight:bold;" value="<?php echo $row->userEmail;?>"   class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                    
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Course (For Student)</label>
                        <input type="text" name="kursus" style="font-weight:bold;" value="<?php echo $row->kursus;?>"   class="form-control" readonly>
                      </div>
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Designations (For Academic/Administration Staff)</label>
                        <input type="text" name="jawatan" style="font-weight:bold;" value="<?php echo $row->jawatan;?>" class="form-control" readonly>
                      </div> 
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Account Status</label>
                      <select  name="statusAcc" class="form-control">
                        <option style="font-weight:bold;" value="<?php echo $row->statusAcc;?>"><?php echo $row->statusAcc;?></option>
                        <option style="font-weight:bold;">PENDING</option>
                        <option style="font-weight:bold;">VERIFIED AS MEMBER</option>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 noprint" name="submit" id="submit">Save</button>
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
<script>
	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
</body>
</html>
<?php }  ?>