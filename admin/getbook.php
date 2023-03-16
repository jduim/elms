<?php 
require_once("includes/config.php");
if(!empty($_POST["bookid"])) {
  $bookid=$_POST["bookid"];
 
  $sql ="SELECT distinct tblbook.title,tblbook.id,tblbook.isissued,tblbook.isbn FROM tblbook
       WHERE (isbn=:bookid || title like '%$bookid%')";
$query= $dbh -> prepare($sql);
$query-> bindParam(':bookid', $bookid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0){
?>
<table border="1">

  <tr>
<?php foreach ($results as $result) {?>
    <th style="padding-left:5%; width: 10%;">
    Book Title: <?php echo htmlentities($result->title); ?><br />
    ISBN Number: <?php echo htmlentities($result->isbn); ?><br />
    <?php if($result->isissued=='1'): ?>
<p style="color:red;">Book already issued (PLEASE DO NOT CLICK ADD BUTTON)</p>
<?php else:?>
<input type="radio" name="bookid" value="<?php echo htmlentities($result->id); ?>" required>
<?php endif;?>
  </th>
    <?php  echo "<script>$('#submit').prop('disabled',false);</script>";
}
?>
  </tr>

</table>
</div>
</div>

<?php  
}else{?>
<p>Record not found. Please try again.</p>
<?php
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
?>
