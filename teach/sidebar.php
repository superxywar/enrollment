<?php
    
    $u_sel = "SELECT firstname, lastname, photo FROM tbl_teacher WHERE teach_id=:teach_id";
    $u_sele= $db->prepare($u_sel);
    $u_sele->bindParam(':teach_id',$_SESSION['teach_id']);
    $u_sele->execute();
    $u_row = $u_sele->fetch();

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="logo/logo.png" alt="AdminLTE Logo" class="img-circle" style="width:55px; height:50px;">
        <span class="brand-text font-weight-light">IPIL-SDA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="../admin/images/<?php echo $u_row['photo']?>" class="img-circle " alt="User Image" style="width:50px; height:50px;">
            </div>
            <div class="info">
            <a href="#" class="d-block" style="text-transform:uppercase;"><?php echo $u_row['firstname'].' '.$u_row['lastname']?></a>
            <small style="color:#FFF;">Teacher</small>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                
                <li class="nav-header">TEACHER</li>
                <li class="nav-item">
                    <a href="index.php?page=app_teacherprofile" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Teacher Profile</p></a>
                </li>
                <li class="nav-header">MODULE</li>
                
                <li class="nav-item">
                    <a href="index.php?page=app_listschedule" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p>Teacher Load</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_listschedules" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p>Grades</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_printgrades" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p>Print Report Card</p></a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link"><i class="nav-icon fas fa-arrow-right"></i><p>Logout</p></a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/script_changeschoolyear.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-calendar-alt"></i> Change Log School Year :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>School Year :</label>
                        <select name="sy_id" class="form-control" required>
                        <?php
                            $g_sel = "SELECT * FROM tbl_schoolyear ORDER BY sy_id ASC";
                            $g_sele= $db->prepare($g_sel);
                            $g_sele->execute();
                            while($g_row=$g_sele->fetch()){
                                echo'<option value="'.$g_row['sy_id'].'">'.$g_row['start_year'].' - '.$g_row['end_year'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_change" class="btn btn-info"><i class="fas fa-check"></i>Change School Year</button> 
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>