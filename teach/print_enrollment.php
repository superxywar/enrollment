<?php
    
    require_once'../../resources/message.php';


    $sg_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $sg_sele= $db->prepare($sg_sel);
    $sg_sele->bindParam(':sy_id',$_POST['sy_id']);
    $sg_sele->execute();
    $sg_row = $sg_sele->fetch();

    $g_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
    $g_sele= $db->prepare($g_sel);
    $g_sele->bindParam(':grade_id',$_POST['grade_id']);
    $g_sele->execute();
    $g_row = $g_sele->fetch();

    $s_sel = "SELECT * FROM tbl_section WHERE section_id=:section_id";
    $s_sele= $db->prepare($s_sel);
    $s_sele->bindParam(':section_id',$_POST['state']);
    $s_sele->execute();
    $s_row = $s_sele->fetch();
?>
<script language="Javascript" type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
        window.location.href = "index.php?page=app_reportenrollment"
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
                    OFFICIAL ENROLLED STUDENT FOR  <br><?php echo $g_row['grade'].' SECTION '.$s_row['section']?>
                </p>
                <hr>
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
                        $su_sel = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND acad_id=:acad_id AND grade_id=:grade_id AND section_id=:section_id";
                        $su_sele= $db->prepare($su_sel);
                        $su_sele->bindParam(':sy_id',$_POST['sy_id']);
                        $su_sele->bindParam(':acad_id',$_POST['acad_id']);
                        $su_sele->bindParam(':grade_id',$_POST['grade_id']);
                        $su_sele->bindParam(':section_id',$_POST['state']);
                        $su_sele->execute();
                        while($su_row=$su_sele->fetch()){
                            

                            $tc_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_student WHERE stud_id=:stud_id";
                            $tc_sele= $db->prepare($tc_sel);
                            $tc_sele->bindParam(':stud_id',$su_row['stud_id']);
                            $tc_sele->execute();
                            $tc_row = $tc_sele->fetch();


                            echo'<tr>';
                                echo'<td style="width:50px;"><label style="font-weight:normal;"> </label></td>';
                                echo'<td><label style="font-weight:normal;">'.$tc_row['name'].'</label></td>';
                                
                                
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
