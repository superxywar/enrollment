<?php
    
    require_once'../../resources/message.php';

    $a_sel = "SELECT * FROM tbl_enroll WHERE enroll_id=:enroll_id";
    $a_sele= $db->prepare($a_sel);
    $a_sele->bindParam(':enroll_id',$_GET['enroll_id']);
    $a_sele->execute();
    $a_row = $a_sele->fetch();

    $aa_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $aa_sele= $db->prepare($aa_sel);
    $aa_sele->bindParam(':sy_id',$a_row['sy_id']);
    $aa_sele->execute();
    $aa_row = $aa_sele->fetch();

    $o_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
    $o_sele= $db->prepare($o_sel);
    $o_sele->bindParam(':grade_id',$a_row['grade_id']);
    $o_sele->execute();
    $o_row = $o_sele->fetch();

    $g_sel = "SELECT *, UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_student WHERE stud_id=:stud_id";
    $g_sele= $db->prepare($g_sel);
    $g_sele->bindParam(':stud_id',$a_row['stud_id']);
    $g_sele->execute();
    $g_row = $g_sele->fetch();

    $l_sel = "SELECT * FROM tbl_section WHERE section_id=:section_id";
    $l_sele= $db->prepare($l_sel);
    $l_sele->bindParam(':section_id',$a_row['section_id']);
    $l_sele->execute();
    $l_row = $l_sele->fetch();
    
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2"></div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="col-12" style="margin:auto; text-align:center; text-transform:uppercase; font-weight:bold;">
                    <p style="padding-top:20px;">
                        ENROLLMENT APPLICATION REQUESTED SUBJECT
                    </p>
                    <hr>
                </div>
                <div class="col-12" style="margin:auto;">
                    <table class="table table-bordered " style="line-height:10.0px;">
                        <tr>
                            <td >Student No. : </td><td><?php echo $g_row['stud_no']?></td>
                            <td>Student Name  : </td><td><?php echo $g_row['name']?></td>
                        </tr>
                        <tr>
                            <td>Grade Level: </td><td><?php echo $o_row['grade']?></td>
                            <td>Section  : </td><td><?php echo $l_row['section']?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-12" style="margin:auto;">
                    
                    <table class="table table-bordered " style="line-height:10.0px;">
                        <thead>
                            <tr>
                                <th>Teacher</th>
                                <th>Room</th>
                                <th>Learning Areas</th>
                                <th>Class Size</th>
                                <th>Day</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $su_sel = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id";
                            $su_sele= $db->prepare($su_sel);
                            $su_sele->bindParam(':enroll_id',$_GET['enroll_id']);
                            $su_sele->execute();
                            while($su_row=$su_sele->fetch()){
                                
                                $u_sel  = "SELECT * FROM tbl_schedule WHERE sched_id=:sched_id  ORDER BY grade_id ASC";
                                $u_sele = $db->prepare($u_sel);
                                $u_sele ->bindParam(':sched_id',$su_row['sched_id']);
                                $u_sele ->execute();
                                $u_row  = $u_sele->fetch();
    
                                $p_sel  = "SELECT * FROM tbl_load WHERE sched_id=:sched_id";
                                $p_sele = $db->prepare($p_sel);
                                $p_sele ->bindParam(':sched_id',$u_row['sched_id']);
                                $p_sele ->execute();
                                $p_row  = $p_sele->fetch();
    
                                $tc_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_teacher WHERE teach_id=:teach_id";
                                $tc_sele= $db->prepare($tc_sel);
                                $tc_sele->bindParam(':teach_id',$p_row['teach_id']);
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
                                    echo'<td><label style="font-weight:normal;">'.$rt_row['room'].'</label></td>';
                                    echo'<td><label style="font-weight:normal;">'.$ts_row['subject'].'</label></td>';
                                    echo'<td><label style="font-weight:normal;">'.$u_row['class_size'].'</label></td>';
                                    echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.$u_row['day'].'</label></td>';
                                    echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.date('h:i A',strtotime($u_row['time_start'])).' - '.date('h:i A',strtotime($u_row['time_end'])).'</label></td>';
                                echo'</tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
                </div>
            </div>
        </div>
    </div>
</section>