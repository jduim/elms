<?php 
require_once("includes/config.php");
// code noic availablity
if(!empty($_POST["isbn"])) {
	$isbn= $_POST["isbn"];

$sql ="SELECT isbn FROM tblbook WHERE isbn=:isbn";
$query= $dbh -> prepare($sql);
$query-> bindParam(':isbn', $isbn, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'>ISBN already exists with another book.</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'>ISBN available</span>";
 echo "<script>$('#dd').prop('disabled',false);</script>";
}
}
?>
