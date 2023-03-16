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
  $fname=$_POST['fname'];
  $userEmail=$_POST['userEmail'];
  $mobilenumber=$_POST['mobilenumber'];
  $noic=$_POST['noic'];
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
  $statusAcc=$_POST['statusAcc'];
  $password=md5($_POST['password']);
  $status=1;


$sql="INSERT INTO  user(fname,userEmail,mobilenumber,noic,nokad,tlahir,tempatlahir,agama,bangsa,tarafkahwin,jenisahli,pendidikan,kursus,jawatan,statusAcc,password,status) 
VALUES(:fname,:userEmail,:mobilenumber,:noic,:nokad,:tlahir,:tempatlahir,:agama,:bangsa,:tarafkahwin,:jenisahli,:pendidikan,:kursus,:jawatan,:statusAcc,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':userEmail',$userEmail,PDO::PARAM_STR);
$query->bindParam(':mobilenumber',$mobilenumber,PDO::PARAM_STR);
$query->bindParam(':noic',$noic,PDO::PARAM_STR);
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
$query->bindParam(':statusAcc',$statusAcc,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Librarian has been added');</script>";
echo "<script>window.location.href='senaraiahli.php'</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";    
echo "<script>window.location.href='tambahahli.php'</script>";
}
}?>
<!DOCTYPE html>
<html>
<head>
 
  <title>ELMS | Add Member</title>
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
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "checkemail.php",
data:'userEmail='+$("#userEmail").val(),
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
function userAvailabilityIC() {
$("#loaderIcon").show();
jQuery.ajax({
url: "checkIC.php",
data:'noic='+$("#noic").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
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
            <h1>Add Librarian</h1>
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
            <div class="card-body">
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-row"> 
                    <div class="form-group col-md-6">    
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" style="font-weight:bold;" name="fname" class="form-control" required='true'>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">IC Number ( without '-' )</label>
                        <input type="text" style="font-weight:bold;" name="noic" id="noic" onBlur="userAvailabilityIC()"  class="form-control" maxlength="12" required='true'>
                        <span id="user-availability-status" style="font-size:12px;"></span>
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1"> Matric Card Number/ Staff Number</label>
                        <input type="text" id="noid" style="font-weight:bold;" name="nokad" class="form-control" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Date of Birth</label>
                        <input type="date"  id="tarikhlahir" style="font-weight:bold;" name="tlahir" class="form-control" >
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Place of Birth</label>
                        <input type="text" style="font-weight:bold;" name="tempatlahir" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Religion</label>
                        <select  name="agama" class="form-control">
                        <option style="font-weight:bold;" value=""></option>
                        <option >Option...</option>
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
                        <input type="text" style="font-weight:bold;" name="bangsa" class="form-control">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Marital</label>
                        <select  name="tarafkahwin" class="form-control">
                        <option >Option...</option>
                        <option style="font-weight:bold;">SINGLE</option>
                        <option style="font-weight:bold;">MARRIED</option>
                        </select>
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" id="userEmail" style="font-weight:bold;" name="userEmail" class="form-control"onBlur="userAvailability()" required>
                        <span id="user-availability-status1" style="font-size:12px;"></span>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Mobile Number</label>
                        <input type="text" style="font-weight:bold;" name="mobilenumber" value="" class="form-control">
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Type of Member</label>
                        <select  name="jenisahli" class="form-control" required>
                        <option value=""></option>
                        <option >Option...</option>
                        <option style="font-weight:bold;">STUDENT</option>
                        <option style="font-weight:bold;">ACADEMIC STAFF</option>
                        <option style="font-weight:bold;">ADMINISTRATION STAFF</option>
                        <option style="font-weight:bold;">PAID MEMBERS</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Education</label>
                        <select  name="pendidikan" class="form-control">
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
                        <input type="text" style="font-weight:bold;" name="kursus"  class="form-control">
                      </div>
                      <div class="form-group col-md-6">
                      <label for="exampleInputName1">Designations (For Academic/Administration Staff)</label>
                        <input type="text" style="font-weight:bold;" name="jawatan" class="form-control">
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Password</label>
                        <input type="text" style="font-weight:bold;" name="password" class="form-control" required>
                      </div>
                      <div class="form-group col-md-6"> 
                      <label for="exampleInputName1">Account Status</label>
                      <select  name="statusAcc" class="form-control" required>
                        <option style="font-weight:bold;" ></option>
                        <option >Select..</option>
                        <option style="font-weight:bold;">PENDING</option>
                        <option style="font-weight:bold;">VERIFIED AS MEMBER</option>
                        </select>
                      </div>
                      </div>
                      <?php } ?>

                      <button type="submit" class="btn btn-primary mr-2" name="add" id="submit">Add Member</button>
                     
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