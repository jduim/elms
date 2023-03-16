<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['elmsaid'])==0)
  { 
header('location:index.php');
}
else{ 
  if(isset($_POST['issue']))
{
$noic=strtoupper($_POST['noic']);
$bookid=$_POST['bookid'];
$isissued=1;
$sql="INSERT INTO tblissuedbook(noic,bookid) VALUES(:noic,:bookid);
update tblbook set isissued=:isissued where id=:bookid;";
$query = $dbh->prepare($sql);
$query->bindParam(':noic',$noic,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->bindParam(':isissued',$isissued,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Book issued successfully";
header('location:uruspeminjam.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:tambahpeminjam.php');
}

}?>
<!DOCTYPE html>
<html>
<head>
 
  <title>ELMS | Add Issue</title>
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
  <script>
// function for get student name
function getuser() {
$("#loaderIcon").show();
jQuery.ajax({
url: "getuser.php",
data:'noic='+$("#noic").val(),
type: "POST",
success:function(data){
$("#get_user_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "getbook.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
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
            <h1>Add Record Issue (Manual)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Issue</li>
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
            <form role="form" method="post">
            <div class="row">
            <div class="form-group col-md-6">
                    <label for="exampleInputName1">Name</label>    
                        <input type="text" name="fname" style="font-weight:bold;" class="form-control" required autocomplete="off">
                      </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputName1">IC Number</label>    
                        <input type="text" name="noic" style="font-weight:bold;" class="form-control" required autocomplete="off">
                      </div>
                    </div>
            <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Book Title</label>   
                        <input type="text" name="title" style="font-weight:bold;" class="form-control" required autocomplete="off">
                      </div>
                      <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">ISBN</label>   
                        <input type="text" name="isbn" style="font-weight:bold;" class="form-control" required autocomplete="off">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Issue Date</label>   
                        <input type="date" name="issuesdate" style="font-weight:bold;" class="form-control" required autocomplete="off">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="issue" id="submit">Add</button>
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
<script>
	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
</body>
</html>
<?php }  ?>