<?php
    require_once'../../resources/script_fee.php';
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Fee</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Grade Level :</label>
                                    <select name="grade_id[]" class="select2" multiple="multiple" data-placeholder="Select Grade Level" required style="width:100%;">
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
                                    <label for="exampleInputEmail1">Fee Name :</label>
                                    <input type="text" class="form-control" name="fee" required placeholder="Input Fee" autocomplete="off"  >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Amount :</label>
                                    <input type="number" class="form-control" name="amount" required placeholder="Input Amount" autocomplete="off"  >
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
                        <h3 class="card-title"><i class="nav-icon fas fa-list"></i>&nbsp;List of Fee</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Grade Level</th>
                                    <th>Fee</th>
                                    <th>Amount</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_fee ORDER BY fee_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        
                                        $h_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                        $h_sele= $db->prepare($h_sel);
                                        $h_sele->bindParam(':grade_id',$u_row['grade_id']);
                                        $h_sele->execute();
                                        $h_row = $h_sele->fetch();

                                        $k_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
                                        $k_sele= $db->prepare($k_sel);
                                        $k_sele->bindParam(':sy_id',$u_row['sy_id']);
                                        $k_sele->execute();
                                        $k_row = $k_sele->fetch();

                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$k_row['start_year'].'-'.$k_row['end_year'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$h_row['grade'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['fee'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">Php '.number_format($u_row['amount'], 2, '.', ',').'</label></td>';
                                            echo'<td>';
                                                echo'<a href="#edit'.$u_row['fee_id'].'" data-toggle="modal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit Fee </a>';
                                                
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
    $jselect  = "SELECT * FROM tbl_fee ORDER BY fee_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){

        $h_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
        $h_sele= $db->prepare($h_sel);
        $h_sele->bindParam(':grade_id',$jrow['grade_id']);
        $h_sele->execute();
        $h_row = $h_sele->fetch();
    
?>
<div class="modal fade" id="edit<?php echo $jrow['fee_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/modify.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list"></i> Edit Fee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Grade Level :</label>
                        <select name="grade_id" class="form-control" required>
                        <option value="<?php echo $h_row['grade_id']?>"><?php echo $h_row['grade']?></option>
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
                        <label>Fee :</label>
                        <input type="text" class="form-control" autocomplete="off" name="fee" value="<?php echo $jrow['fee'];?>" required="required" onkeypress="return /[a-z]/i.test(event.key)">
                    </div>
                    <div class="form-group">
                        <label>Amount :</label>
                        <input type="number" class="form-control" autocomplete="off" name="amount" value="<?php echo $jrow['amount'];?>" required="required" >
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="feeID" value="<?php echo $jrow['fee_id']?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="modify_fee<?php echo $jrow['fee_id']?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit Save</button> 
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