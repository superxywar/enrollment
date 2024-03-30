<?php
    $t_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $t_sele= $db->prepare($t_sel);
    $t_sele->bindParam(':sy_id',$_SESSION['sy_id']);
    $t_sele->execute();
    $t_row = $t_sele->fetch();

    require_once'../../resources/script_schedule.php';
    require_once'../../resources/message.php';
    
    
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2"></div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <form method="post" action="../../resources/script_insertload.php">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-calendar-alt"></i>&nbsp;List of Schedule School Year : <?php echo $t_row['start_year'].' - '.$t_row['end_year']?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    <th>Room</th>
                                    <th>Learning Areas</th>
                                    <th>Class Size</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_schedule WHERE sy_id=:sy_id AND NOT EXISTS(SELECT sched_id FROM tbl_load WHERE tbl_schedule.sched_id=tbl_load.sched_id) ORDER BY sched_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->bindParam(':sy_id',$_SESSION['sy_id']);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        
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
                                            echo'<td>';
                                                echo'<input type="checkbox" id="checkboxDanger1" name="sched_id'.$u_row['sched_id'].'" value="'.$u_row['sched_id'].'">';
                                            echo'</td>';
                                            echo'<td><label style="font-weight:normal;">'.$gr_row['grade'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$rs_row['section'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$rt_row['room'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$ts_row['subject'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['class_size'].'</label></td>';
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.$u_row['day'].'</label></td>';
                                            
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.date('h:i A',strtotime($u_row['time_start'])).' - '.date('h:i A',strtotime($u_row['time_end'])).'</label></td>';
                                            
                                        echo'</tr>';
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <a href="#assign" data-toggle="modal" class="btn btn-success" style="float:right;"><i class="nav-icon fas fa-calendar-alt"></i>&nbsp;Load Schedule</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-calendar"></i> System Message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><span class="text text-danger">*</span> Select Teacher</label>
                                                <select name="teach_id" class="form-control" required>
                                                    <option value="">Select Teacher</option>
                                                    <?php
                                                        $r_sel = "SELECT *, UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_teacher WHERE status='Active'";
                                                        $r_sele= $db->prepare($r_sel);
                                                        $r_sele->execute();
                                                        while($r_row=$r_sele->fetch()){
                                                            echo'<option value="'.$r_row['teach_id'].'">'.$r_row['name'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" name="btn_submit" class="btn btn-success"><i class="fa fa-check"></i> Load Schedule</button> 
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        <!-- /.modal-dialog -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </form>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-calendar-alt"></i>&nbsp;Teachers Load for School Year : <?php echo $t_row['start_year'].' - '.$t_row['end_year']?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
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
                                    $su_sel = "SELECT * FROM tbl_load WHERE sy_id=:sy_id ORDER BY load_id DESC";
                                    $su_sele= $db->prepare($su_sel);
                                    $su_sele->bindParam(':sy_id',$_SESSION['sy_id']);
                                    $su_sele->execute();
                                    while($su_row=$su_sele->fetch()){
                                        
                                        $u_sel  = "SELECT * FROM tbl_schedule WHERE sched_id=:sched_id";
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
                                            echo'<td><label style="font-weight:normal;">'.$tc_row['name'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$gr_row['grade'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$rs_row['section'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$rt_row['room'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$ts_row['subject'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['class_size'].'</label></td>';
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.$u_row['day'].'</label></td>';
                                            
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.date('h:i A',strtotime($u_row['time_start'])).' - '.date('h:i A',strtotime($u_row['time_end'])).'</label></td>';
                                            
                                            $n_sel = "SELECT * FROM tbl_enrollsub WHERE load_id=:load_id";
                                            $n_sele= $db->prepare($n_sel);
                                            $n_sele->bindParam(':load_id',$su_row['load_id']);
                                            $n_sele->execute();
                                            if($n_sele->rowCount()>=1){
                                            echo'<td>';
                                                echo'<a href="" data-toggle="modal" class="btn btn-default"><i class="nav-icon fas fa-trash"></i>&nbsp;Remove</a>';
                                            echo'</td>';        
                                            }
                                            else{
                                            echo'<td>';
                                                echo'<a href="#load'.$su_row['load_id'].'" data-toggle="modal" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i>&nbsp;Remove</a>';
                                            echo'</td>';
                                            }
                                            
                                        echo'</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?php
    $jselect  = "SELECT * FROM tbl_load WHERE sy_id=:sy_id ORDER BY load_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->bindParam(':sy_id',$_SESSION['sy_id']);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="load<?php echo $jrow['load_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message Prompt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label>Are you sure you want to remove this load?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?load_id=<?php echo $jrow['load_id']?>&confirm=10" class="btn btn-danger"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>