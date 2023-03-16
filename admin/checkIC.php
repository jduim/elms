<?php 
require_once("includes/config.php");
// code noic availablity
if(!empty($_POST["noic"])) {
	$noic= $_POST["noic"];

$sql ="SELECT noic FROM user WHERE noic=:noic";
$query= $dbh -> prepare($sql);
$query-> bindParam(':noic', $noic, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> IC Number already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> IC Number available for Registration.</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
?>
