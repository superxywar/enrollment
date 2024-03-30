<?php
    require_once'../../resources/script_academic.php';
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Academic Program</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
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
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Program Name :</label>
                                    <input type="text" class="form-control" name="name" required placeholder="Input Program Name" autocomplete="off" >
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
                        <h3 class="card-title"><i class="nav-icon fas fa-list-alt"></i>&nbsp;List of Academic Program</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Program Name</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_academic ORDER BY acad_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        
                                        $h_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
                                        $h_sele= $db->prepare($h_sel);
                                        $h_sele->bindParam(':sy_id',$u_row['sy_id']);
                                        $h_sele->execute();
                                        $h_row = $h_sele->fetch();

                                        if($u_row['status']=='Inactive'){
                                            $stat  = '<label style="font-weight:normal; color:red;">INACTIVE</label>';
                                        }
                                        else{
                                            $stat  = '<label style="font-weight:normal; color:green;">ACTIVE</label>';
                                        }
                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$h_row['start_year'].' - '.$h_row['end_year'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['program_name'].'</label></td>';
                                            echo'<td>'.$stat.'</td>';
                                            echo'<td>';
                                                
                                                if($u_row['status']=='Inactive'){
                                                    
                                                    if($u_row['stat_prep']==''){
                                                        echo'<a href="#edit'.$u_row['acad_id'].'" data-toggle="modal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit Academic Program </a>&nbsp;';
                                                        echo'<a href="index.php?page=app_programsubject&acad_id='.$u_row['acad_id'].'"  class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Add Subject </a>&nbsp;';
                                                    }
                                                    else{
                                                        echo'<a href="print.php?page=print_acadsub&acad_id='.$u_row['acad_id'].'" class="btn btn-info btn-sm"><i class="fas fa-search"></i> View Program</a>&nbsp;';
                                                    }
                                                    
                                                    echo'<a href="#active'.$u_row['acad_id'].'" data-toggle="modal" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Set to active </a>';
                                                }
                                                else{
                                                    echo'<a href="#inactive'.$u_row['acad_id'].'" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fas fa-check"></i> Set to inactive </a>&nbsp;';
                                                    echo'<a href="print.php?page=print_acadsub&acad_id='.$u_row['acad_id'].'" class="btn btn-info btn-sm"><i class="fas fa-search"></i> View Program</a>&nbsp;';
                                                }
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
    $jselect  = "SELECT * FROM tbl_academic ORDER BY acad_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="edit<?php echo $jrow['acad_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/modify.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list-alt"></i> Edit Academic Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Progam Name :</label>
                        <input type="text" class="form-control" autocomplete="off" name="name" value="<?php echo $jrow['program_name'];?>" required="required">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="acadID" value="<?php echo $jrow['acad_id']?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="modify_acad<?php echo $jrow['acad_id']?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit Save</button> 
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="active<?php echo $jrow['acad_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you sure you want to change status to active?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?acad_id=<?php echo $jrow['acad_id']?>&confirm=3" class="btn btn-success">Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="inactive<?php echo $jrow['acad_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you sure you want to change status to inactive?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?acad_id=<?php echo $jrow['acad_id']?>&confirm=4" class="btn btn-success">Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>