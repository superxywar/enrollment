<?php
    require_once'../../resources/script_academicsubject.php';
    require_once'../../resources/message.php';

    $a_sel = "SELECT * FROM tbl_academic WHERE acad_id=:acad_id";
    $a_sele= $db->prepare($a_sel);
    $a_sele->bindParam(':acad_id',$_GET['acad_id']);
    $a_sele->execute();
    $a_row = $a_sele->fetch();

    $sg_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $sg_sele= $db->prepare($sg_sel);
    $sg_sele->bindParam(':sy_id',$a_row['sy_id']);
    $sg_sele->execute();
    $sg_row = $sg_sele->fetch();

?>
<script language="Javascript" type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
        window.location.href = "index.php?page=app_academicprogram"
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
                    <?php echo $a_row['program_name']?>
                </p>
                <hr>
            </div>
            <div class="col-10" style="margin:auto;">
                <table class="table table-bordered " style="line-height:0.5px;">
                    
                        <tbody>
                            <?php
                                $u_sel = "SELECT grade_id FROM tbl_acadcon WHERE acad_id=:acad_id GROUP BY grade_id ORDER BY grade_id ASC";
                                $u_sele= $db->prepare($u_sel);
                                $u_sele->bindParam(':acad_id',$_GET['acad_id']);
                                $u_sele->execute();
                                while($u_row=$u_sele->fetch()){
                                    $gh_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id ";
                                    $gh_sele= $db->prepare($gh_sel);
                                    $gh_sele->bindParam(':grade_id',$u_row['grade_id']);
                                    $gh_sele->execute();
                                    $gh_row = $gh_sele->fetch();

                                    echo'<tr>';
                                            echo'<td colspan="2" style="background-color:#9999;"><label style="font-weight:bold;">'.$gh_row['grade'].'</label></td>';
                                    echo'</tr>';
                                    $k_sel = "SELECT sub_id FROM tbl_acadcon WHERE acad_id=:acad_id AND grade_id=:grade_id";
                                    $k_sele= $db->prepare($k_sel);
                                    $k_sele->bindParam(':acad_id',$_GET['acad_id']);
                                    $k_sele->bindParam(':grade_id',$u_row['grade_id']);
                                    $k_sele->execute();
                                    
                                    while($k_row = $k_sele->fetch()){

                                        $h_sel = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                        $h_sele= $db->prepare($h_sel);
                                        $h_sele->bindParam(':sub_id',$k_row['sub_id']);
                                        $h_sele->execute();
                                        $h_row = $h_sele->fetch();

                                        
                                        echo'<tr>';
                                            echo'<td style="width:50px;"></td>';
                                            echo'<td><label style="font-weight:bold;">'.$h_row['subject'].'</label></td>';
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
