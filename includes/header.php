 <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div>
          <a href="issue-book.php">
          <div>
                <img src="images/picture1.png" style="text-align: center;" width="150" height="60">
                </div>
          </a>
         
        </div>
        <?php
         $uid= $_SESSION['noic'];
$sql="SELECT * from user where noic=:uid";

$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex"> Welcome <?php  echo htmlentities($row->fname);?> to UIM Library !</h5>
          <ul class="navbar-nav navbar-nav-right ml-auto">
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <?php $cnt=$cnt+1;}} ?>