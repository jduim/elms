<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['elmsaid'])==0)
  { 
header('location:index.php');
}
else{ 
    if(isset($_POST['update']))
    {
      $uid=$_GET['id'];
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

      $sql="update tblbook set source=:source,title=:title,isbn=:isbn,callnumber=:callnumber,mainentry=:mainentry,author=:author,placeofpublication=:placeofpublication,
      publisher=:publisher,year=:year,edition=:edition,physicaldesc=:physicaldesc,series=:series,notesarea=:notesarea,subject=:subject,addedentry=:addedentry,price=:price,
      copies=:copies,date=:date,note=:note where id=:uid";
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
      $query->bindParam(':uid',$uid,PDO::PARAM_STR);
      $query->execute();
      echo '<script>alert("Update succesfully")</script>';
    }
    ?>
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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Book Information</li>
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
            <h4 style="text-align: center;">BOOK'S INFORMATION</h4>
            <form class="forms-sample" method="post" enctype="multipart/form-data">
            <?php
$uid=$_GET['id'];
$sql="SELECT * from tblbook where id=$uid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
            <div class="row">
            <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Resource</label>
                      <select  name="source" class="form-control">
                        <option style="font-weight:bold;" value="<?php echo $row->source;?>"><?php echo $row->source;?></option>
                        <option style="font-weight:bold;">Library Materials</option>
                        <option style="font-weight:bold;">Waqaf Brunei</option>
                        <option style="font-weight:bold;">Donation</option>
                        <option style="font-weight:bold;">Waqaf Dato Manaf</option>
                        <option style="font-weight:bold;">Waqaf Dato Hj Sharani Abdullah</option>
                        <option style="font-weight:bold;">Waqaf Datuk Haji Mohamed bin Am</option>
                        <option style="font-weight:bold;">Sumbangan Kakitangan</option>
                        <option style="font-weight:bold;">Sample</option>
                        <option style="font-weight:bold;">Kuwait</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                    <label for="exampleInputName1">Title</label>    
                        <input type="text" name="title" value="<?php echo $row->title;?>" style="font-weight:bold;" class="form-control" required>
                      </div>
                    </div>
            <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">ISBN Number</label>   
                        <input type="text" name="isbn" value="<?php echo $row->isbn;?>" id="isbn" style="font-weight:bold;" class="form-control" onBlur="checkisbnAvailability()" required>
                        <span id="isbn-availability-status" style="font-size:12px;"></span>
                      </div>
                      <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Call Number</label>   
                        <input type="text" name="callnumber" value="<?php echo $row->callnumber;?>" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Main Entry</label>   
                        <input type="text" name="mainentry" value="<?php echo $row->mainentry;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Author</label>   
                        <input type="text" name="author" value="<?php echo $row->author;?>" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Place of Publication</label>   
                        <input type="text" name="placeofpublication" value="<?php echo $row->placeofpublication;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Publisher</label>   
                        <input type="text" name="publisher" value="<?php echo $row->publisher;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Year</label>   
                        <input type="text" name="year" value="<?php echo $row->year;?>" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Edition</label>   
                        <input type="text" name="edition" value="<?php echo $row->edition;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Physical Description</label>   
                        <input type="text" name="physicaldesc" value="<?php echo $row->physicaldesc;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Series</label>   
                        <input type="text" name="series" value="<?php echo $row->series;?>" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Notes Area</label>   
                        <input type="text" name="notesarea" value="<?php echo $row->notesarea;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Subject</label>   
                        <input type="text" name="subject" value="<?php echo $row->subject;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Added Entry</label>   
                        <input type="text" name="addedentry" value="<?php echo $row->addedentry;?>" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6"> 
                    <label for="exampleInputName1">Price</label>   
                        <input type="text" name="price" value="<?php echo $row->price;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Copies</label>   
                        <input type="text" name="copies" value="<?php echo $row->copies;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Date</label>   
                        <input type="text" name="date" value="<?php echo $row->date;?>" style="font-weight:bold;" class="form-control">
                      </div>
                      <div class="form-group col-md-3"> 
                    <label for="exampleInputName1">Note</label>   
                        <input type="text" name="note" value="<?php echo $row->note;?>" style="font-weight:bold;" class="form-control">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="update" id="update">Update</button>
           
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
<script>
	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
</body>
</html>
<?php }  ?>