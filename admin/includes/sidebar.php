 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link" style="font-weight:bold; font-size:22px;">
    

      <span class="brand-text font-weight-light">Library | ADMIN | UIM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <?php
         $aid= $_SESSION['elmsaid'];
$sql="SELECT * from tbladmin where id=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image" >
                    <?php $gambaradmin=$row->gambaradmin;
                    if($gambaradmin==""):
                    ?>
                    <img src="adminphoto/noimages.png" class="img-circle elevation-2" alt="User Image">
                    <?php else:?>
                    <a href="adminphoto/<?php  echo htmlentities($row->gambaradmin);?>" data-lightbox="mygallery"><img src="adminphoto/<?php  echo htmlentities($row->gambaradmin);?>"></a>
                    <?php endif;?>
                    </div>
        <div class="info">
          <a href="admin-profile.php" class="d-block">Welcome : <?php  echo htmlentities($row->username);?> <br> <?php  echo htmlentities($row->staffno);?> </a>
        </div>
      </div>
      <?php $cnt=$cnt+1;}} ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p>
                Admin Setting
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile Update</p>
                </a>
              </li>
              <!--li class="nav-item">
                <a href="change-password.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li-->
              <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
             </ul>
          </li>   
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               </p>
            </a>
        
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Patrons
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tambahahli.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="senaraiahli.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Member</p>
                </a>
              </li>
             </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Circulation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tambahpeminjam.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Borrowing</p>
                </a>
              </li>
              <!--li class="nav-item">
                <a href="tambahpeminjamM.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Borrower (Manual)</p>
                </a>
              </li-->
              <li class="nav-item">
                <a href="uruspeminjam.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Returning</p>
                </a>
              </li>
            </ul>
          </li>
           
<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Book
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tambahbuku.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Book</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="urusbuku.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Book</p>
                </a>
              </li>
            </ul>
          </li>
          <!--li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notice
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-notice.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Notice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage-notice.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Notice</p>
                </a>
              </li-->
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>