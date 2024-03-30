<?php
    require_once'../../resources/script_section.php';
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Section</h3>
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
                                            $g_sel = "SELECT * FROM tbl_gradelevel ORDER BY grade_id ASC";
                                            $g_sele= $db->prepare($g_sel);
                                            $g_sele->execute();
                                            while($g_row=$g_sele->fetch()){
                                                echo'<option value="'.$g_row['grade_id'].'">'.$g_row['grade'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section :</label>
                                    <input type="text" class="form-control" name="section" required placeholder="Input Section" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
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
                        <h3 class="card-title"><i class="nav-icon fas fa-user-alt"></i>&nbsp;List of Section</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_section ORDER BY section_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        
                                        $h_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                        $h_sele= $db->prepare($h_sel);
                                        $h_sele->bindParam(':grade_id',$u_row['grade_id']);
                                        $h_sele->execute();
                                        $h_row = $h_sele->fetch();

                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$h_row['grade'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['section'].'</label></td>';
                                            echo'<td>';
                                                echo'<a href="#edit'.$u_row['section_id'].'" data-toggle="modal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit Section </a>';
                                                
                                            echo'</td>';
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
    $jselect  = "SELECT * FROM tbl_section ORDER BY section_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="edit<?php echo $jrow['section_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/modify.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list-alt"></i> Edit Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Grade Level :</label>
                        <select name="grade_id" class="form-control" required>
                        <option value="">Select Grade Level</option>
                        <?php
                            $g_sel = "SELECT * FROM tbl_gradelevel ORDER BY grade_id ASC";
                            $g_sele= $db->prepare($g_sel);
                            $g_sele->execute();
                            while($g_row=$g_sele->fetch()){
                                echo'<option value="'.$g_row['grade_id'].'">'.$g_row['grade'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Section :</label>
                        <input type="text" class="form-control" autocomplete="off" name="section" value="<?php echo $jrow['section'];?>" required="required" onkeypress="return /[a-z]/i.test(event.key)">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="sectionID" value="<?php echo $jrow['section_id']?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="modify_section<?php echo $jrow['section_id']?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit Save</button> 
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