<?php
    require_once'../../resources/script_schoolyear.php';
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-calendar-alt"></i>&nbsp;&nbsp;School Year</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php
                            $k_sel = "SELECT * FROM tbl_schoolyear ORDER BY sy_id DESC";
                            $k_sele= $db->prepare($k_sel);
                            $k_sele->execute();

                            if($k_sele->rowCount()>=1){
                            $k_row = $k_sele->fetch();
                            $starty= $k_row['end_year'];
                            $endy  = $starty + 1;
                        ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start Year :</label>
                                    <input type="number" readonly value="<?php echo $starty?>" class="form-control" name="start" required placeholder="Enter Start Year" autocomplete="off"  >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">End Year :</label>
                                    <input type="number" readonly value="<?php echo $endy?>" class="form-control" name="end"  required placeholder="Enter End Year" autocomplete="off" >
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                            else{
                        ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start Year :</label>
                                    <input type="number" class="form-control" name="start" required placeholder="Enter Start Year" autocomplete="off"  >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">End Year :</label>
                                    <input type="number" class="form-control" name="end"  required placeholder="Enter End Year" autocomplete="off" >
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
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
                        <h3 class="card-title"><i class="nav-icon fas fa-calendar-alt"></i>&nbsp;List of School Year</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_schoolyear ORDER BY sy_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){

                                        if($u_row['status']=='Inactive'){
                                            $status = '<label style="font-weight:normal; color:red;">'.$u_row['status'].'</label>';
                                        }
                                        else{
                                            $status = '<label style="font-weight:normal; color:green;">'.$u_row['status'].'</label>';
                                        }
                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['start_year'].'-'.$u_row['end_year'].'</label></td>';
                                            echo'<td>'.$status.'</td>';
                                            echo'<td>';
                                            if($u_row['status']=='Inactive'){
                                                echo'<a href="#active'.$u_row['sy_id'].'" data-toggle="modal" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Set to Active </a>';
                                            }
                                            else{
                                                //echo'<a href="#inactive'.$u_row['sy_id'].'" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fas fa-edit"></i> Set to Inactive </a>';
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
    $jselect  = "SELECT * FROM tbl_schoolyear ORDER BY sy_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="active<?php echo $jrow['sy_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you sure you want to set active this school year?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?sy_id=<?php echo $jrow['sy_id']?>&confirm=1" class="btn btn-success"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="inactive<?php echo $jrow['sy_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you sure you want to set inactive this school year?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?sy_id=<?php echo $jrow['sy_id']?>&confirm=2" class="btn btn-success"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>