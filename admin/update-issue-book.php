<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['elmsaid'])==0)
  { 
header('location:index.php');
}
else{
    if(isset($_POST['return']))
{
$rid=intval($_GET['rid']);
$fine=$_POST['fine'];
$rstatus=1;
$bookid=$_POST['bookid'];
$sql="update tblissuedbook set fine=:fine,returnstatus=:rstatus where id=:rid;
update tblbook set isissued=0 where id=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Book Returned successfully";
header('location:uruspeminjam.php');



} ?>
<!DOCTYPE html>
<html>
<head>
 
  <title>ELMS | Issued Book Details</title>
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
            <h1>Issued Book Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Issued Book Details</li>
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
<?php 
$rid=intval($_GET['rid']);
$sql = "SELECT user.noic,user.fname,user.userEmail,user.mobilenumber,tblbook.title,tblbook.isbn,
tblissuedbook.issuesdate,tblissuedbook.returndate,tblissuedbook.note,tblissuedbook.id as rid,tblissuedbook.fine,tblissuedbook.returnstatus,
tblbook.id as bid,tblbook.title from  tblissuedbook join user on user.noic=tblissuedbook.noic
join tblbook on tblbook.id=tblissuedbook.bookid where tblissuedbook.id=:rid";
$query = $dbh -> prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 
<input type="hidden" name="bookid" value="<?php echo htmlentities($result->bid);?>">
            <h4>MEMBER DETAILS</h4>
            <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Name</label>
                        <input type="text" name="fname" style="font-weight:bold;" value="<?php echo $result->fname;?>" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Email</label>
                        <input type="text" name="email" style="font-weight:bold;" value="<?php echo $result->userEmail;?>" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Mobile Number</label>
                        <input type="text" name="mobilenumber" style="font-weight:bold;" value="<?php echo $result->mobilenumber;?>" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">IC Number</label>
                        <input type="text" name="noic" style="font-weight:bold;" value="<?php echo $result->noic;?>"   class="form-control" readonly>
                      </div>
                    </div>
                    <h4>BOOK DETAILS</h4>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Title</label>
                        <input type="text" name="title" style="font-weight:bold;" value="<?php echo $result->title;?>" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">ISBN</label>
                        <input type="text" name="isbn" style="font-weight:bold;" value="<?php echo $result->isbn;?>" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Issue Date</label>
                        <input type="text" name="issuedate" style="font-weight:bold;" value="<?php echo $result->issuesdate;?>" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Returned Date</label>
                        
                        <input type="text" name="returndate" style="font-weight:bold;" value="<?php if($result->returndate=="")
                                            {
                                                echo htmlentities("Not Return Yet");
                                            } else {


                                            echo htmlentities($result->returndate);
}
                                            ?>" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Fine (RM)</label>
                        <?php 
if($result->fine=="")
{?>
                        <input type="text" name="fine" id="fine" style="font-weight:bold;" value="<?php echo $result->fine;?>" class="form-control" required>
                        <?php }else {
echo htmlentities($result->fine);
}
?>
                      </div>
                      <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Note (Pre-return date)</label>
                        <input type="text" name="note" style="font-weight:bold;" value="<?php echo $result->note;?>" class="form-control" readonly>
                      </div>
                    </div>
                    <?php if($result->returnstatus==0){?>
                        <button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>
            </div>
            <?php }}} ?>
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
<?php } ?>