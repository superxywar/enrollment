<?php
    
    $u_sel = "SELECT lrn_number, guardian_name FROM tbl_student WHERE stud_id=:stud_id";
    $u_sele= $db->prepare($u_sel);
    $u_sele->bindParam(':stud_id',$_SESSION['stud_id']);
    $u_sele->execute();
    $u_row = $u_sele->fetch();

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="logo/logo.png" alt="SDA Logo" class="img-circle" style="width:55px; height:50px;">
        <span class="brand-text font-weight-light">IPIL-SDA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="../admin/logo/father.png" class="img-circle " alt="User Image" style="width:50px; height:50px;">
            </div>
            <div class="info">
            <a href="#" class="d-block" style="text-transform:uppercase;"><?php echo $u_row['guardian_name']?></a>
            <small style="color:#FFF;">Guardian</small>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                
                <li class="nav-header">STUDENT</li>
                <li class="nav-item">
                    <a href="index.php?page=app_student" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Student Profile</p></a>
                </li>
                <li class="nav-header">MODULE</li>
                
                <li class="nav-item">
                    <?php
                        if($u_row['lrn_number']==''){
                            echo'<a href="#message" data-toggle="modal" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p>Enrollment Application</p></a>';
                        }
                        else{
                            echo'<a href="index.php?page=app_listapplication" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p>Enrollment Application</p></a>';
                        }
                    ?>
                    
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_listschedule" class="nav-link"><i class="nav-icon fas fa-calendar-alt"></i><p>Schedule and Grades</p></a>
                </li>
                <li class="nav-header">RECORD</li>
                <li class="nav-item">
                    <a href="index.php?page=app_studentrecord" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Student Record</p></a>
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


<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-envelope"></i> Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <p>Please fill - up your student information.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
</div>