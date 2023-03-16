<?php 
require_once("includes/config.php");
if(!empty($_POST["noic"])) {
  $noic= strtoupper($_POST["noic"]);
 
    $sql ="SELECT fname,jenisahli,statusAcc,noic,userEmail,mobilenumber,Status FROM user WHERE noic=:noic";
$query= $dbh -> prepare($sql);
$query-> bindParam(':noic', $noic, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<span style='color:red'> User account has been blocked</span>"."<br />";
echo "<b>Full Name-</b>" .$result->fname;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>


<?php  
echo "<b>Full Name - </b>".$result->fname ."<br />";
echo "<b>Member Type - </b>".$result->jenisahli ."<br />";
echo "<b style='color:red'>Status Account - </b>".$result->statusAcc ."<br />";
echo "<b>IC Number - </b>".$result->noic ."<br />";
echo "<b>Email - </b>".$result->userEmail ."<br />";
echo "<b>Mobile number - </b>".$result->mobilenumber ."<br />";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Invalid IC number. Please Enter Valid IC number.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
