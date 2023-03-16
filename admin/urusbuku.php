<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['elmsaid'])==0)
  { 
header('location:index.php');
}
else{ ?>
<!DOCTYPE html>
<html>
<head>
 
  <title>ELMS | Senarai Ahli</title>
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
            <h1>Master Catalog</h1><br><!--a href="#" onclick="printDiv()"><i class="nav-icon fas fa-print"></i></a-->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Book</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th class="font-weight-bold">No</th>
                <th class="font-weight-bold">Source</th>
                <th class="font-weight-bold">Title</th>
                <th class="font-weight-bold">ISBN</th>
                <th class="font-weight-bold">Main Entry</th>
                <th class="font-weight-bold">Call Number</th>
                <th class="font-weight-bold">Author</th>
                <th class="font-weight-bold">Year</th>
                <th class="font-weight-bold">Copies</th>
                <th class="font-weight-bold noprint">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $sql = "SELECT * from tblbook";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 		
                            <tr>
                              <td><?php echo htmlentities($cnt);?></td>
                              <td><?php echo htmlentities($result->source);?></td>
                              <td><?php echo htmlentities($result->title);?></td>
                              <td><?php echo htmlentities($result->isbn);?></td>
                              <td><?php echo htmlentities($result->mainentry);?></td>
                              <td><?php echo htmlentities($result->callnumber);?></td>
                              <td><?php echo htmlentities($result->author);?></td>
                              <td><?php echo htmlentities($result->year);?></td>
                              <td><?php echo htmlentities($result->copies);?></td>
                              <td class="noprint"><div class="d-flex align-items-center">
                                <a href="viewbuku.php?id=<?php echo htmlentities($result->id);?>" class="btn btn-success btn-sm btn-icon-text mr-3">View <i class="typcn typcn-edit btn-icon-append"></i> </a> 
                          </div></td>
                          <style>
@media print {
   .noprint {
      visibility: hidden;
   }
}
</style> 
                            </tr>
							  
                            <?php $cnt=$cnt+1; } } ?>
                        </tbody>
              </table>
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
function printDiv() {
    var divToPrint = document.getElementById('example1');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        'padding;0.5em;' +
        '}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}
</script>
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