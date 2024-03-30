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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Academic Program Program</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Grade Level :</label>
                                    <select name="grade_id" class="form-control" required>
                                        <option value="">Select Grade Level</option>
                                        <?php
                                            $rg_sel = "SELECT * FROM tbl_gradelevel ORDER BY grade_id ASC";
                                            $rg_sele= $db->prepare($rg_sel);
                                            $rg_sele->execute();
                                            while($rg_row=$rg_sele->fetch()){
                                                echo'<option value="'.$rg_row['grade_id'].'">'.$rg_row['grade'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject :</label>
                                    <select name="sub_id[]" class="select2" multiple="multiple" data-placeholder="Select Subject" style="width:100%;" required>
                                        <option value="">Select Subject</option>
                                        <?php
                                            $bg_sel = "SELECT * FROM tbl_subject ORDER BY sub_id ASC";
                                            $bg_sele= $db->prepare($bg_sel);
                                            $bg_sele->execute();
                                            while($bg_row=$bg_sele->fetch()){
                                                echo'<option value="'.$bg_row['sub_id'].'">'.$bg_row['subject'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Time Allotment :</label>
                                    
                                    <div class="col-4" style="display:inline-block;">
                                        <div class="form-group">
                                            <select name="min" class="select2" style="width:100%;" required>
                                                <option value="">Select No. of Min</option>
                                                <option value="15">15 Min</option>
                                                <option value="20">20 Min</option>
                                                <option value="30">30 Min</option>
                                                <option value="40">40 Min</option>
                                                <option value="45">45 Min</option>
                                                <option value="50">50 Min</option>
                                                <option value="60">60 Min</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="btn_save" style="float:right;"><i class="nav-icon fas fa-check"></i>&nbsp;Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-user-alt"></i>&nbsp;List of Subject under in this Academic Program</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Grade Level</th>
                                    <th>Subject</th>
                                    <th>Minutes</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_acadcon WHERE acad_id=:acad_id ORDER BY acadcon_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->bindParam(':acad_id',$_GET['acad_id']);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        
                                        $h_sel = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                        $h_sele= $db->prepare($h_sel);
                                        $h_sele->bindParam(':sub_id',$u_row['sub_id']);
                                        $h_sele->execute();
                                        $h_row = $h_sele->fetch();

                                        $gh_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                        $gh_sele= $db->prepare($gh_sel);
                                        $gh_sele->bindParam(':grade_id',$u_row['grade_id']);
                                        $gh_sele->execute();
                                        $gh_row = $gh_sele->fetch();
                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$gh_row['grade'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$h_row['subject'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['min'].' min</label></td>';
                                            echo'<td>';
                                                echo'<a href="#remove'.$u_row['acadcon_id'].'" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fas fa-remove"></i> Remove </a>';
                                            echo'</td>';
                                        echo'</tr>';
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <a href="#done" data-toggle="modal" class="btn btn-success" style="float:right; margin-left:5px;">Done Adding Subject</a>
                                        <a href="index.php?page=app_academicprogram" class="btn btn-info" style="float:right;">Finish Later</a>
                                        
                                    </td>
                                </tr>
                            </tfoot>
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
    $jselect  = "SELECT * FROM tbl_acadcon WHERE acad_id=:acad_id ORDER BY acadcon_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->bindParam(':acad_id',$_GET['acad_id']);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>

<div class="modal fade" id="remove<?php echo $jrow['acadcon_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you sure you want to remove this subject from this program?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?acad_id=<?php echo $_GET['acad_id']?>&acadcon_id=<?php echo $jrow['acadcon_id']?>&confirm=5" class="btn btn-success">Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<?php
    }
?>
<div class="modal fade" id="done" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you done adding subject in this program?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?acad_id=<?php echo $_GET['acad_id']?>&confirm=6" class="btn btn-success">Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>