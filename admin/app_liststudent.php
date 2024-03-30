<?php
    require_once'../../resources/script_teacher.php';
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-user-alt"></i>&nbsp;List of Student</h3>
                        <a href="index.php?page=app_student" class="btn btn-success" style="float:right;"><i class="nav-icon fas fa-plus"></i>&nbsp;Add New Student</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>LRN Number</th>
                                    <th>Student No.</th>
                                    <th>Student Name</th>
                                    
                                    <th>Birth Date</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT *, UPPER(CONCAT(firstname,' ',lastname,' ',ext_name)) AS student_name FROM tbl_student ORDER BY stud_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        // get the age
                                        $bday = new DateTime($u_row['birth_date']); // Your date of birth
                                        $today = new Datetime(date('Y-m-d'));
                                        $diff = $today->diff($bday);
                                        $age  = $diff->y;

                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['lrn_number'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['stud_no'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['student_name'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.date('F j, Y',strtotime($u_row['birth_date'])).'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$age.'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['gender'].'</label></td>';
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.$u_row['address'].'</label></td>';
                                            echo'<td>';
                                                echo'<a href="index.php?page=app_editstudent&stud_id='.$u_row['stud_id'].'" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit Student Profile </a>';
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
    $jselect  = "SELECT * FROM tbl_teacher ORDER BY teach_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="edit<?php echo $jrow['teach_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/modify.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-user"></i> Edit Teacher Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Firstname :</label>
                        <input type="text" class="form-control" autocomplete="off" name="firstname" value="<?php echo $jrow['firstname'];?>" required="required" onkeypress="return /[a-z]/i.test(event.key)">
                    </div>
                    <div class="form-group">
                        <label>Lastname :</label>
                        <input type="text" class="form-control" autocomplete="off" name="lastname" value="<?php echo $jrow['lastname'];?>" required="required" onkeypress="return /[a-z]/i.test(event.key)">
                    </div>
                    <div class="form-group">
                        <label>Address :</label>
                        <input type="text" class="form-control" autocomplete="off" name="address" value="<?php echo $jrow['address'];?>" required="required" onkeypress="return /[a-z]/i.test(event.key)">
                    </div>
                    <div class="form-group">
                        <label>Contact No. :</label>
                        <input type="tel" class="form-control" name="contact" value="<?php echo $jrow['contact_no']?>" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11"  onkeydown="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode >= 96 && event.keyCode <= 105" placeholder="Contact No.">
                    </div>
                    <div class="form-group">
                        <label>E - mail :</label>
                        <input type="email" class="form-control" autocomplete="off" name="email" value="<?php echo $jrow['email'];?>" required="required">
                    </div>
                    <div class="form-group">
                        <label>Gender :</label>
                        <select name="gender" class="form-control">
                            <option value="<?php echo $jrow['gender']?>"><?php echo $jrow['gender']?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Civil Status :</label>
                        <select name="civil" class="form-control">
                            <option value="<?php echo $jrow['civil_status']?>"><?php echo $jrow['civil_status']?></option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="separated">Separated</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="teachID" value="<?php echo $jrow['teach_id']?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="modify_teach<?php echo $jrow['teach_id']?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit Save</button> 
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="active<?php echo $jrow['teach_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you sure you want to set active?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?teach_id=<?php echo $jrow['teach_id']?>&confirm=7" class="btn btn-success"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="inactive<?php echo $jrow['teach_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you sure you want to set inactive?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?teach_id=<?php echo $jrow['teach_id']?>&confirm=8" class="btn btn-danger"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>