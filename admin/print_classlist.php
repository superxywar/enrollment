<?php
    
    require_once'../../resources/message.php';

    $o_sel  = "SELECT * FROM tbl_schedule WHERE sched_id=:sched_id";
    $o_sele = $db->prepare($o_sel);
    $o_sele ->bindParam(':sched_id',$_GET['sched_id']);
    $o_sele ->execute();
    $o_row  = $o_sele->fetch();

    $sg_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $sg_sele= $db->prepare($sg_sel);
    $sg_sele->bindParam(':sy_id',$o_row['sy_id']);
    $sg_sele->execute();
    $sg_row = $sg_sele->fetch();

    $g_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
    $g_sele= $db->prepare($g_sel);
    $g_sele->bindParam(':grade_id',$o_row['grade_id']);
    $g_sele->execute();
    $g_row = $g_sele->fetch();

    $s_sel = "SELECT * FROM tbl_section WHERE section_id=:section_id";
    $s_sele= $db->prepare($s_sel);
    $s_sele->bindParam(':section_id',$o_row['section_id']);
    $s_sele->execute();
    $s_row = $s_sele->fetch();

    $l_sel = "SELECT * FROM tbl_load WHERE sched_id=:sched_id";
    $l_sele= $db->prepare($l_sel);
    $l_sele->bindParam(':sched_id',$_GET['sched_id']);
    $l_sele->execute();
    $l_row = $l_sele->fetch();

    $t_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_teacher WHERE teach_id=:teach_id";
    $t_sele= $db->prepare($t_sel);
    $t_sele->bindParam(':teach_id',$l_row['teach_id']);
    $t_sele->execute();
    $t_row = $t_sele->fetch();


    $r_sel = "SELECT * FROM tbl_room WHERE room_id=:room_id";
    $r_sele= $db->prepare($r_sel);
    $r_sele->bindParam(':room_id',$o_row['room_id']);
    $r_sele->execute();
    $r_row = $r_sele->fetch();

    $y_sel = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
    $y_sele= $db->prepare($y_sel);
    $y_sele->bindParam(':sub_id',$o_row['sub_id']);
    $y_sele->execute();
    $y_row = $y_sele->fetch();

    //get the number of minutes
    $datetime1 = new DateTime($o_row['time_start']);
    $datetime2 = new DateTime($o_row['time_end']);
    $interval = $datetime1->diff($datetime2);
    
?>
<script language="Javascript" type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
        window.location.href = "index.php?page=app_reportschedule"
    };
</script>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2"></div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8" style="margin:auto; text-align:center; text-transform:uppercase; font-weight:bold;">
                <p>
                    CLASSLIST<br> FOR  <br><?php echo $g_row['grade'].' - '.$s_row['section']?>
                </p>
                <hr>
            </div>
            <div class="col-8" style="margin:auto;">
                <table class="table table-bordered " style="line-height:10.0px;">
                    <tr>
                        <td>Teacher Name : </td><td><?php echo $t_row['name']?></td>
                        <td>Room  : </td><td><?php echo $r_row['room']?></td>
                    </tr>
                    <tr>
                        <td>Subject : </td><td><?php echo $y_row['subject']?></td>
                        <td>Day  : </td><td><?php echo $o_row['day']?></td>
                    </tr>
                    <tr>
                        <td>Time : </td><td><?php echo date('h:i A',strtotime($o_row['time_start'])).' - '.date('h:i A',strtotime($o_row['time_end']))?></td>
                        <td>No. of Minutes : </td><td><?php echo $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";?></td>
                        
                    </tr>
                </table>
            </div>
            <div class="col-8" style="margin:auto;">
                
                <table class="table table-bordered " style="line-height:10.0px;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Student Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $su_sel = "SELECT * FROM tbl_enrollsub WHERE sched_id=:sched_id";
                        $su_sele= $db->prepare($su_sel);
                        $su_sele->bindParam(':sched_id',$_GET['sched_id']);
                        $su_sele->execute();
                        while($su_row=$su_sele->fetch()){
                            
                            $e_sel  = "SELECT * FROM tbl_enroll WHERE enroll_id=:enroll_id AND stat_enroll='Enrolled'";
                            $e_sele = $db->prepare($e_sel);
                            $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                            $e_sele ->execute();
                            if($e_sele->rowCount()>=1){
                            $e_row  = $e_sele->fetch();

                            $tc_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_student WHERE stud_id=:stud_id";
                            $tc_sele= $db->prepare($tc_sel);
                            $tc_sele->bindParam(':stud_id',$e_row['stud_id']);
                            $tc_sele->execute();
                            $tc_row = $tc_sele->fetch();


                            echo'<tr>';
                                echo'<td style="width:50px;"><label style="font-weight:normal;"> </label></td>';
                                echo'<td><label style="font-weight:normal;">'.$tc_row['name'].'</label></td>';
                            echo'</tr>';
                            }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
