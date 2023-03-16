<?php 
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["userEmail"])) {
	$userEmail= $_POST["userEmail"];
	if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)===false) {

		echo "error : You did not enter a valid email.";
	}
	else {
		$sql ="SELECT userEmail FROM user WHERE userEmail=:userEmail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Email already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Email available for Registration.</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}


?>
