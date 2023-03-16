<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
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
                <div class="profile-image">
                <?php $userphoto=$row->userphoto;
                    if($userphoto==""):
                    ?>
                  <img class="img-xs rounded-circle" src="userphoto/noimages.png" alt="profile image">
                  <?php else:?>
                    <img class="img-xs rounded-circle ml-2" src="userphoto/<?php echo htmlentities($row->userphoto);?>" >
                    <?php endif;?>
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php  echo htmlentities($row->nokad);?></p>
                  <!--p class="designation"><?php  echo htmlentities($row->noic);?></p-->
                </div>
             
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                <p class="mb-1 mt-3" style="font-weight:bold;"><?php  echo htmlentities($row->fname);?></p><?php $cnt=$cnt+1;}} ?>
                </div>
                <a class="dropdown-item"><?php 
                                    $statusAcc=$row->statusAcc;
                                    if($statusAcc=="" or $statusAcc=="NULL" or $statusAcc=="PENDING")
                                    { ?>
                                      <button type="button" class="btn btn-warning">PENDING</button>
                                   <?php }
if($statusAcc=="VERIFIED AS MEMBER") {
?>
<button type="button" class="btn btn-success">VERIFIED AS MEMBER</button>
<?php } ?></button>
                <a class="dropdown-item" href="change-password.php"><i class="dropdown-item-icon icon-energy text-primary"></i> Change Password</a>
                <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon icon-power text-primary"></i> Log Out</a>
              </div>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">MENU</span>
            </li>
            <!--li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li-->
            <!--li class="nav-item">
              <a class="nav-link" href="notice-board.php">
                <span class="menu-title">Home</span>
                <i class="icon-home menu-icon"></i>
              </a>
            </li-->
            <li class="nav-item">
              <a class="nav-link" href="profile.php">
                <span class="menu-title">Profile</span>
                <i class="icon-user menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Books</span>
                <i class="icon-book-open menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="issue-book.php">Borrowed Book</a></li>
                  <li class="nav-item"> <a class="nav-link" href="listbooks.php">List of Books</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>