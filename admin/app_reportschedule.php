<?php
    require_once'../../resources/message.php';
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2"></div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header" style="background-color:#343a40;">
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Class Schedule and Class List Report</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post"  enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School Year :</label>
                                    <select name="sy_id" class="form-control" required>
                                        <option value="">Select School Year</option>
                                        <?php
                                            $g_sel = "SELECT * FROM tbl_schoolyear ORDER BY sy_id ASC";
                                            $g_sele= $db->prepare($g_sel);
                                            $g_sele->execute();
                                            while($g_row=$g_sele->fetch()){
                                                echo'<option value="'.$g_row['sy_id'].'">'.$g_row['start_year'].'-'.$g_row['end_year'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="btn_search" style="float:right;"><i class="nav-icon fas fa-search"></i>&nbsp;Generate Report</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<?php
    if(isset($_POST['btn_search'])){
        $sg_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
        $sg_sele= $db->prepare($sg_sel);
        $sg_sele->bindParam(':sy_id',$_POST['sy_id']);
        $sg_sele->execute();
        $sg_row = $sg_sele->fetch();
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <!-- general form elements -->
                <div class="card card-primary">
                    <div class="col-8" style="margin:auto; text-align:center; text-transform:uppercase; font-weight:bold; padding-top:40px;">
                        <p>
                            CLASS SCHEDULE FOR S.Y. : <?php echo $sg_row['start_year'].' - '.$sg_row['end_year']?>
                        </p>
                        <hr>
                    </div>
                    <div class="col-12" style="margin:auto;">
                        
                        <table class="table table-bordered " style="line-height:10.0px;">
                            <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    <th>Room</th>
                                    <th>Learning Areas</th>
                                    <th>Class Size</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $su_sel = "SELECT * FROM tbl_load WHERE sy_id=:sy_id";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':sy_id',$_POST['sy_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                                
                                    $u_sel  = "SELECT * FROM tbl_schedule WHERE sched_id=:sched_id  ORDER BY grade_id ASC";
                                    $u_sele = $db->prepare($u_sel);
                                    $u_sele ->bindParam(':sched_id',$su_row['sched_id']);
                                    $u_sele ->execute();
                                    $u_row  = $u_sele->fetch();

                                    $tc_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_teacher WHERE teach_id=:teach_id";
                                    $tc_sele= $db->prepare($tc_sel);
                                    $tc_sele->bindParam(':teach_id',$su_row['teach_id']);
                                    $tc_sele->execute();
                                    $tc_row = $tc_sele->fetch();

                                    $gr_sel = "SELECT grade FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $gr_sele= $db->prepare($gr_sel);
                                    $gr_sele->bindParam(':grade_id',$u_row['grade_id']);
                                    $gr_sele->execute();
                                    $gr_row = $gr_sele->fetch();

                                    $ts_sel = "SELECT subject FROM tbl_subject WHERE sub_id=:sub_id";
                                    $ts_sele= $db->prepare($ts_sel);
                                    $ts_sele->bindParam(':sub_id',$u_row['sub_id']);
                                    $ts_sele->execute();
                                    $ts_row = $ts_sele->fetch();

                                    $rt_sel = "SELECT room FROM tbl_room WHERE room_id=:room_id";
                                    $rt_sele= $db->prepare($rt_sel);
                                    $rt_sele->bindParam(':room_id',$u_row['room_id']);
                                    $rt_sele->execute();
                                    $rt_row = $rt_sele->fetch();

                                    $rs_sel = "SELECT section FROM tbl_section WHERE section_id=:section_id";
                                    $rs_sele= $db->prepare($rs_sel);
                                    $rs_sele->bindParam(':section_id',$u_row['section_id']);
                                    $rs_sele->execute();
                                    $rs_row = $rs_sele->fetch();


                                    echo'<tr>';
                                        echo'<td><a href="print.php?page=print_classlist&sched_id='.$su_row['sched_id'].'" style="color:#000;">'.$tc_row['name'].'</a></td>';
                                        echo'<td><label style="font-weight:normal;">'.$gr_row['grade'].'</label></td>';
                                        echo'<td><label style="font-weight:normal;">'.$rs_row['section'].'</label></td>';
                                        echo'<td><label style="font-weight:normal;">'.$rt_row['room'].'</label></td>';
                                        echo'<td><label style="font-weight:normal;">'.$ts_row['subject'].'</label></td>';
                                        echo'<td><label style="font-weight:normal;">'.$u_row['class_size'].'</label></td>';
                                        echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.$u_row['day'].'</label></td>';
                                        echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.date('h:i A',strtotime($u_row['time_start'])).' - '.date('h:i A',strtotime($u_row['time_end'])).'</label></td>';
                                        echo'<td><a href="print.php?page=print_classlist&sched_id='.$su_row['sched_id'].'"  class="btn btn-primary"><i class="fas fa-search"></i> View Class List</a></td>';
                                    echo'</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12" style="padding:20px;" >
                        <a href="print.php?page=print_schedule&sy_id=<?php echo $_POST['sy_id']?>" class="btn btn-info" style="float:right;"><i class="fas fa-print"></i> Print Report </a>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<?php
    }
    
?>