<?php
    $u_sel = "SELECT firstname, lastname, user_type, photo FROM tbl_useraccount WHERE user_id=:user_id";
    $u_sele= $db->prepare($u_sel);
    $u_sele->bindParam(':user_id',$_SESSION['user_id']);
    $u_sele->execute();
    $u_row = $u_sele->fetch();
    

    $pii_sel = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stat_enroll='Pending Application'";
    $pii_sele= $db->prepare($pii_sel);
    $pii_sele->bindParam(':sy_id',$_SESSION['sy_id']);
    $pii_sele->execute();
    if($pii_sele->rowCount()>=1){
        $pii_count = $pii_sele->rowCount();
    }
    
    else{
        $pii_count =0 ;
    }

    $a_sel = "SELECT * FROM tbl_academic WHERE status='Active'";
    $a_sele= $db->prepare($a_sel);
    $a_sele->execute();
    if($a_sele->rowCount()==1){
        $a_row = $a_sele->fetch(); 
        $acad_id    = $a_row['acad_id'];
        $acad_name  = $a_row['program_name'];
    }
    else{
        $acad_id = 0;
    }
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
            <img src="images/<?php echo $u_row['photo']?>" class="img-circle " alt="User Image" style="width:50px; height:50px;">
            </div>
            <div class="info">
            <a href="#" class="d-block" style="text-transform:uppercase;"><?php echo $u_row['firstname'].' '.$u_row['lastname']?></a>
            <small style="color:#FFF;"><?php echo $u_row['user_type']?></small>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
                if($u_row['user_type']=='Admin'){
            ?>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-header">SYSTEM SETTINGS</li>
                <li class="nav-item">
                    <a href="index.php?page=app_schoolyear" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>School Year</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_user" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>System User Account</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?page=app_section" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Section</p></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=app_subject" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Subject</p></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=app_academicprogram" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Academic Program</p></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=app_room" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Room</p></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=app_fee" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Fee</p></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_event" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>School Year Calendar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_slider" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-header">OFFICIAL AND TEACHER</li>
                <li class="nav-item">
                    <a href="index.php?page=app_official" class="nav-link"><i class="nav-icon fas fa-user"></i><p>OfficialProfile</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_teacher" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Teacher Profile</p></a>
                </li>
                <li class="nav-header">MODULE</li>
                <li class="nav-item">
                    <a href="#select" data-toggle="modal" class="nav-link"><i class="nav-icon fas fa-calendar-alt"></i><p>Schedule</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_listschedule" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p>Teacher Load</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_liststudent" class="nav-link"><i class="nav-icon fas fa-user-alt"></i><p>Student Profile</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_enrollment" class="nav-link"><i class="nav-icon fas fa-folder"></i><p>Enrollment Module</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_listpenenrollment" class="nav-link"><i class="nav-icon fas fa-folder"></i><p>EN Pending Application <span class="badge badge-danger right"><?php echo $pii_count;?></span></p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_payment" class="nav-link"><i class="nav-icon fas fa-folder"></i><p>Payment Module</p></a>
                </li>
                <li class="nav-header">RECORD</li>
                <li class="nav-item">
                    <a href="index.php?page=app_studentrecord" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Student Record</p></a>
                </li>
                <li class="nav-header">REPORTS</li>
                <li class="nav-item">
                    <a href="index.php?page=app_reportschedule" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Schedule</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_reportenrollment" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Enrollment</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_reportdailycollection" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Collection</p></a>
                </li>
                <li class="nav-header">LINKS</li>
                <li class="nav-item">
                    <a href="#change" data-toggle="modal" class="nav-link"><i class="nav-icon fas fa-cog"></i><p>Change School Year</p></a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link"><i class="nav-icon fas fa-arrow-right"></i><p>Logout</p></a>
                </li>
            </ul>
            <?php
                }
                elseif($u_row['user_type']=='Staff'){
            ?>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-header">SYSTEM SETTINGS</li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?page=app_section" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Section</p></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=app_subject" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Subject</p></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=app_academicprogram" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Academic Program</p></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=app_room" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Room</p></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=app_fee" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Fee</p></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_event" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>School Year Calendar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_slider" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-header">TEACHER</li>
                <li class="nav-item">
                    <a href="index.php?page=app_teacher" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Teacher Profile</p></a>
                </li>
                <li class="nav-header">MODULE</li>
                <li class="nav-item">
                    <a href="index.php?page=app_schedule" class="nav-link"><i class="nav-icon fas fa-calendar-alt"></i><p>Schedule</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_listschedule" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p>Teacher Load</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_liststudent" class="nav-link"><i class="nav-icon fas fa-user-alt"></i><p>Student Profile</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_enrollment" class="nav-link"><i class="nav-icon fas fa-folder"></i><p>Enrollment Module</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_listpenenrollment" class="nav-link"><i class="nav-icon fas fa-folder"></i><p>EN Pending Application <span class="badge badge-danger right"><?php echo $pii_count;?></span></p></a>
                </li>
                <li class="nav-header">RECORD</li>
                <li class="nav-item">
                    <a href="index.php?page=app_studentrecord" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Student Record</p></a>
                </li>
                <li class="nav-header">REPORTS</li>
                <li class="nav-item">
                    <a href="index.php?page=app_reportschedule" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Schedule</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_reportenrollment" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Enrollment</p></a>
                </li>
                <li class="nav-header">LINKS</li>
                <li class="nav-item">
                    <a href="#change" data-toggle="modal" class="nav-link"><i class="nav-icon fas fa-cog"></i><p>Change School Year</p></a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link"><i class="nav-icon fas fa-arrow-right"></i><p>Logout</p></a>
                </li>
            </ul>
            <?php
                }
                else{
            ?>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-header">MODULE</li>
                
                <li class="nav-item">
                    <a href="index.php?page=app_enrollment" class="nav-link"><i class="nav-icon fas fa-folder"></i><p>Enrollment Module</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_payment" class="nav-link"><i class="nav-icon fas fa-folder"></i><p>Payment Module</p></a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=app_listpenenrollment" class="nav-link"><i class="nav-icon fas fa-folder"></i><p>EN Pending Application <span class="badge badge-danger right"><?php echo $pii_count;?></span></p></a>
                </li>
                <li class="nav-header">RECORD</li>
                <li class="nav-item">
                    <a href="index.php?page=app_studentrecord" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Student Record</p></a>
                </li>
                <li class="nav-header">REPORTS</li>
                <li class="nav-item">
                    <a href="index.php?page=app_reportdailycollection" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Collection</p></a>
                </li>
                <li class="nav-header">LINKS</li>
                <li class="nav-item">
                    <a href="#change" data-toggle="modal" class="nav-link"><i class="nav-icon fas fa-cog"></i><p>Change School Year</p></a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link"><i class="nav-icon fas fa-arrow-right"></i><p>Logout</p></a>
                </li>
            </ul>
            <?php
                }
            ?>
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
<?php
    if($acad_id==0){

    }
    else{
?>
<script>
    function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp=false;  
        try{
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)    {       
            try{            
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1){
                    xmlhttp=false;
                }
            }
        }
            
        return xmlhttp;
    }
    function getState(countryId) {      
        
        var strURL="select_section.php?country="+countryId;
        var req = getXMLHTTP();
        
        if (req) {
            
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {                        
                        document.getElementById('statediv').innerHTML=req.responseText;                     
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }               
            }           
            req.open("GET", strURL, true);
            req.send(null);
        }  
    }
</script>
<div class="modal fade" id="select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/script_setgradesec.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-calendar-alt"></i> Please select grade level and section :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Grade Level :</label>
                        <select name="grade_id" class="form-control select2" onChange="getState(this.value)" required>
                            <option value="">Select Grade Level</option>
                            <?php
                                $g_sel = "SELECT * FROM tbl_gradelevel WHERE EXISTS(SELECT * FROM tbl_acadcon WHERE tbl_acadcon.acad_id='$acad_id' AND tbl_gradelevel.grade_id=tbl_acadcon.grade_id GROUP BY grade_id)";
                                $g_sele= $db->prepare($g_sel);
                                $g_sele->execute();
                                if($g_sele->rowCount()>=1){
                                    while($g_row=$g_sele->fetch()){
                                        echo'<option value="'.$g_row['grade_id'].'">'.$g_row['grade'].'</option>';
                                    }
                                }         
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Section :</label>
                        <div id="statediv">    
                            <select name="state" required style="width: 100%;" class="form-control">
                            <option value="">Select Section</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_select" class="btn btn-info"><i class="fas fa-check"></i>Select</button> 
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>