<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['elmsaid'])==0)
  { 
header('location:index.php');
}
else{

  if(isset($_POST['add']))
{
$source=$_POST['source'];
$title=$_POST['title'];
$isbn=$_POST['isbn'];
$callnumber=$_POST['callnumber'];
$mainentry=$_POST['mainentry'];
$author=$_POST['author'];
$placeofpublication=$_POST['placeofpublication'];
$publisher=$_POST['publisher'];
$year=$_POST['year'];
$edition=$_POST['edition'];
$physicaldesc=$_POST['physicaldesc'];
$series=$_POST['series'];
$notesarea=$_POST['notesarea'];
$subject=$_POST['subject'];
$addedentry=$_POST['addedentry'];
$price=$_POST['price'];
$copies=$_POST['copies'];
$date=$_POST['date'];
$note=$_POST['note'];

$sql="INSERT INTO  tblbook(source,title,isbn,callnumber,mainentry,author,placeofpublication,publisher,year,edition,physicaldesc,series,notesarea,
subject,addedentry,price,copies,date,note) VALUES(:source,:title,:isbn,:callnumber,:mainentry,:author,:placeofpublication,:publisher,
:year,:edition,:physicaldesc,:series,:notesarea,:subject,:addedentry,:price,:copies,:date,:note)";
$query = $dbh->prepare($sql);
$query->bindParam(':source',$source,PDO::PARAM_STR);
$query->bindParam(':title',$title,PDO::PARAM_STR);
$query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
$query->bindParam(':callnumber',$callnumber,PDO::PARAM_STR);
$query->bindParam(':mainentry',$mainentry,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':placeofpublication',$placeofpublication,PDO::PARAM_STR);
$query->bindParam(':publisher',$publisher,PDO::PARAM_STR);
$query->bindParam(':year',$year,PDO::PARAM_STR);
$query->bindParam(':edition',$edition,PDO::PARAM_STR);
$query->bindParam(':physicaldesc',$physicaldesc,PDO::PARAM_STR);
$query->bindParam(':series',$series,PDO::PARAM_STR);
$query->bindParam(':notesarea',$notesarea,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':addedentry',$addedentry,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->bindParam(':copies',$copies,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':note',$note,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Book Listed successfully');</script>";
echo "<script>window.location.href='urusbuku.php'</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";    
echo "<script>window.location.href='urusbuku.php'</script>";
}
} ?>
<!DOCTYPE html>
<html>
<head>
 
  <title>ELMS | Add Book</title>
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
  <script type="text/javascript">
    function checkisbnAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "checkbook.php",
data:'isbn='+$("#isbn").val(),
type: "POST",
success:function(data){
$("#isbn-availability-status").html(data);
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
            <h1>Add Book</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add</li>
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
            <form role="form" method="post" enctype="multipart/form-data">
            <div class="card-body">
            <div class="row">
            <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Resource</label>
                      <select name="source" class="form-control" id="default" required="required">
<option value="">Option..</option>
<?php $sql = "SELECT * from tblresource";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->resource); ?>"><?php echo htmlentities($result->resource); ?></option>
<?php }} ?>
 </select>
                      </div>
            </div>

                      <div class="row">
                      <div class="form-group col-md-6"> 
                      <a href="add-resource.php"><i class="fa fa-plus">Add New Resource</i></a>
                      </div>
                      </div>
<div class="row">
                      <div class="form-group col-md-6">
                    <label for="exampleInputName1">Title</label>    
                        <input type="text" name="title" id="namabuku" style="font-weight:bold;" class="form-control" required>
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Note</label>   
                        <input type="text" name="note" style="font-weight:bold;" class="form-control">
                      </div>
</div>
                    
            <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">ISBN Number</label>   
                        <input type="text" name="isbn" id="isbn" style="font-weight:bold;" class="form-control" onBlur="checkisbnAvailability()" required>
                        <span id="isbn-availability-status" style="font-size:12px;"></span>
                      </div>
                      <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Call Number</label>   
                        <input type="text" name="callnumber" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Main Entry</label>   
                        <input type="text" name="mainentry" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Author</label>   
                        <input type="text" name="author" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Place of Publication</label>   
                        <input type="text" name="placeofpublication" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Publisher</label>   
                        <input type="text" name="publisher" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Year</label>   
                        <input type="text" name="year" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Edition</label>   
                        <input type="text" name="edition" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Physical Description</label>   
                        <input type="text" name="physicaldesc" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Series</label>   
                        <input type="text" name="series" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Notes Area</label>   
                        <input type="text" name="notesarea" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Subject</label>   
                        <input type="text" name="subject" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Added Entry</label>   
                        <input type="text" name="addedentry" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Price</label>   
                        <input type="text" name="price" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Copies</label>   
                        <input type="text" name="copies" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Date</label>   
                        <input type="date" name="date" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="add" id="add">Add Book</button>
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