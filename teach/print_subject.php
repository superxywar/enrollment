<?php
    require_once'../../resources/script_academicsubject.php';
    require_once'../../resources/message.php';

    $e_sel = "SELECT * FROM tbl_enroll WHERE enroll_id=:enroll_id";
    $e_sele= $db->prepare($e_sel);
    $e_sele->bindParam(':enroll_id',$_GET['enroll_id']);
    $e_sele->execute();
    $e_row = $e_sele->fetch();

    $a_sel = "SELECT * FROM tbl_academic WHERE acad_id=:acad_id";
    $a_sele= $db->prepare($a_sel);
    $a_sele->bindParam(':acad_id',$e_row['acad_id']);
    $a_sele->execute();
    $a_row = $a_sele->fetch();

    $sg_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $sg_sele= $db->prepare($sg_sel);
    $sg_sele->bindParam(':sy_id',$e_row['sy_id']);
    $sg_sele->execute();
    $sg_row = $sg_sele->fetch();

    $g_sel = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
    $g_sele= $db->prepare($g_sel);
    $g_sele->bindParam(':stud_id',$e_row['stud_id']);
    $g_sele->execute();
    $g_row = $g_sele->fetch();

    $l_sel = "SELECT * FROM tbl_section WHERE section_id=:section_id";
    $l_sele= $db->prepare($l_sel);
    $l_sele->bindParam(':section_id',$e_row['section_id']);
    $l_sele->execute();
    $l_row = $l_sele->fetch();

    $f_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
    $f_sele= $db->prepare($f_sel);
    $f_sele->bindParam(':grade_id',$e_row['grade_id']);
    $f_sele->execute();
    $f_row = $f_sele->fetch();


?>
<script language="Javascript" type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
       window.location.href = "index.php?page=app_enrollment"
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
                    STUDENT SCHEDULE AND SUBJECT LOAD
                </p>
                <hr>
            </div>
            <div class="col-10" style="margin:auto;">
                <table class="table table-bordered " style="line-height:10.0px;">
                    <thead>
                             
                        <tr>
                            <th style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;" colspan="4">Student No. : <span style="font-weight:normal;"><?php echo $g_row['stud_no']?></span></th>   
                        </tr>
                        <tr >
                            <th style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;" colspan="4">Name : <span style="font-weight:normal;"><?php echo $g_row['lastname'].', '.$g_row['firstname']?></span></th>   
                        </tr>
                        <tr >
                            <th style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;">Grade : <span style="font-weight:normal;"> <?php echo $f_row['grade']?></span></th>  
                            <th style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;" colspan="2">Academic Year : <span style="font-weight:normal;"><?php echo $sg_row['start_year'].'-'.$sg_row['end_year']?></span></th> 
                        </tr>
                        <tr >
                            <th style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;">Section : <span style="font-weight:normal;"><?php echo $l_row['section']?></span></th>  
                            <th style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;" colspan="2"></th> 
                        </tr>
                    </thead>
                    <tbody>
                    <tr >
                        <th style="padding-top:8px; padding-bottom:5px; padding-left:10px; border:solid #000 1px;">TEACHER</th>
                        <th style="padding-top:8px; padding-bottom:5px; padding-left:10px; border:solid #000 1px;">SUBJECT</th>
                        <th style="padding-top:8px; padding-bottom:5px; padding-left:10px; border:solid #000 1px;">DAY & TIME</th>
                    </tr>
                    <?php
                        $sel_query ="SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id ORDER BY ensub_id DESC";
                        $select_query =$db->prepare($sel_query);
                        $select_query->bindParam(':enroll_id',$e_row['enroll_id']);
                        $select_query->execute();
                        while($row_sel =$select_query->fetch()){
                                        
                            $v_sel = "SELECT * FROM tbl_schedule WHERE sched_id=:sched_id";
                            $v_sele= $db->prepare($v_sel);
                            $v_sele->bindParam(':sched_id',$row_sel['sched_id']);
                            $v_sele->execute();
                            $v_row = $v_sele->fetch();

                            $g_sel = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                            $g_sele= $db->prepare($g_sel);
                            $g_sele->bindParam(':sub_id',$v_row['sub_id']);
                            $g_sele->execute();
                            $g_row = $g_sele->fetch();

                            $y_sel = "SELECT * FROM tbl_load WHERE load_id=:load_id";
                            $y_sele= $db->prepare($y_sel);
                            $y_sele->bindParam(':load_id',$row_sel['load_id']);
                            $y_sele->execute();
                            $y_row = $y_sele->fetch();

                            $f_sel = "SELECT * FROM tbl_teacher WHERE teach_id=:teach_id";
                            $f_sele= $db->prepare($f_sel);
                            $f_sele->bindParam(':teach_id',$y_row['teach_id']);
                            $f_sele->execute();
                            $f_row = $f_sele->fetch();


                            echo'<tr>';
                                echo'<td style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;"><b>'.$f_row['lastname'].', '.$f_row['firstname'].'</b></td>'; 
                                echo'<td style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;">'.$g_row['subject'].'</td>'; 
                                echo'<td style="padding-bottom:5px; padding-left:10px; border:solid #000 1px;"><b>'.$v_row['day'].'</b> &  '.date('h:i A',strtotime($v_row['time_start'])).' - '.date('h:i A',strtotime($v_row['time_end'])).'</td>';          
                            echo'</tr>';
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
