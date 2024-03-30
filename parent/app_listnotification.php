<?php
    
    require_once'../../resources/message.php';
    
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
                    <div class="col-12" style="margin:auto; text-align:left; text-transform:uppercase; font-weight:bold; padding-top:40px;">
                        <p style="padding-left:15px; padding-bottom:5px;">
                        NOTIFICATION
                        </p>
                        <hr>
                    </div>
                    <div class="col-12" style="margin:auto;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">Date</th>
                                    <th style="font-size: 12px;">Message</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                                $sel_query ="SELECT * FROM tbl_notif WHERE stud_id=:stud_id ORDER BY notif_id DESC LIMIT 5";
                                $select_query =$db->prepare($sel_query);
                                $select_query->bindParam(':stud_id',$_SESSION['stud_id']);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){
                                    
                                    
                                    echo'<tr>';
                                        echo'<td>'.date('F j, Y', strtotime($row_sel['date'])).'</td>'; 
                                        echo'<td> '.$row_sel['message'].'</td>'; 
                                    echo'</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $jselect  = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND section_id!=0 ORDER BY enroll_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->bindParam(':stud_id',$_SESSION['stud_id']);
    $jquery->execute();
    $jrow=$jquery->fetch();

    $grade_id = $jrow['grade_id'] + 1;


    if($grade_id>6){}
    else{

        $f_sel  = "SELECT * FROM tbl_schoolyear WHERE status='Active'";
        $f_sele = $db->prepare($f_sel);
        $f_sele ->execute();
        $f_row  = $f_sele->fetch();

        $fa_sel  = "SELECT * FROM tbl_academic WHERE status='Active'";
        $fa_sele = $db->prepare($fa_sel);
        $fa_sele ->execute();
        $fa_row  = $fa_sele->fetch();
        
        $query	=	"SELECT * FROM tbl_section WHERE grade_id=:grade_id";
        $queries= $db->prepare($query);
        $queries->bindParam(':grade_id',$grade_id);
        $queries->execute();
    
?>
<div class="modal fade" id="apply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/script_request.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list"></i>Enrollment Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label for="exampleInputEmail1">Grade Level :</label>
                        <input type="hidden" name="grade_id" value="<?php echo $grade_id?>" >
                        <input type="text" value="<?php echo 'Grade '.$grade_id?>" class="form-control" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label>Section :</label>
                        <select  name="state" class="form-control select2" required>
                            <option value="">Select Section</option>
                            <?php 
                                while($row=$queries->fetch()){

                                    $h_sel = "SELECT teach_id FROM tbl_schedule WHERE sy_id=:sy_id AND section_id=:section_id GROUP BY teach_id";
                                    $h_sele= $db->prepare($h_sel);
                                    $h_sele->bindParam(':sy_id',$f_row['sy_id']);
                                    $h_sele->bindParam(':section_id',$row['section_id']);
                                    $h_sele->execute();
                                    $h_row = $h_sele->fetch();

                                    $b_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_teacher WHERE teach_id=:teach_id";
                                    $b_sele= $db->prepare($b_sel);
                                    $b_sele->bindParam(':teach_id',$h_row['teach_id']);
                                    $b_sele->execute();
                                    $b_row = $b_sele->fetch();
                            ?>
                                <option value="<?php echo $row['section_id'];?>"><?php echo $row['section'];?> ADVISER : <?php echo $b_row['name']?></option>
                            <?php 
                                } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="sy_id" value="<?php echo $f_row['sy_id']?>">
                    <input type="hidden" name="acad_id" value="<?php echo $fa_row['acad_id']?>">
                    <input type="hidden" name="stud_id" value="<?php echo $_SESSION['stud_id']?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_submit" class="btn btn-info"><i class="fas fa-check"></i> Submit Request</button> 
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