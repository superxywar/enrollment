<?php
    require_once'../../resources/script_official.php';
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-user-alt"></i>&nbsp;&nbsp;Official Profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Firstname :</label>
                                    <input type="text" class="form-control" name="firstname" required placeholder="Input Firstname" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lastname :</label>
                                    <input type="text" class="form-control" name="lastname"  required placeholder="Input Lastname" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address :</label>
                                    <input type="text" class="form-control" name="address" required placeholder="Input Address" autocomplete="off"  >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail :</label>
                                    <input type="email" class="form-control" name="email" required placeholder="Input E-mail" autocomplete="off"  >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact No. :</label>
                                    <input type="tel" class="form-control" name="contact" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11"  onkeydown="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode >= 96 && event.keyCode <= 105" placeholder="Input Contact No.">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gender :</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Position :</label>
                                    <select name="position" class="form-control">
                                        <option value="">Select Position</option>
                                        <option value="Grade 1">Grade 1</option>
                                        <option value="Grade 2">Grade 2</option>
                                        <option value="Grade 3">Grade 3</option>
                                        <option value="Grade 4">Grade 4</option>
                                        <option value="Grade 5">Grade 5</option>
                                        <option value="Grade 6">Grade 6</option>
                                        <option value="Kinder Adviser">Kinder Adviser</option>
                                        <option value="School Principal">School Principal</option>
                                        <option value="School Guard">SCHOOL GUARD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Photo :</label>
                                    <input type="file" class="form-control" name="file"  required  autocomplete="off" >
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
                        <h3 class="card-title"><i class="nav-icon fas fa-user-alt"></i>&nbsp;List of Official</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>E-mail</th>
                                    <th>Contact No.</th>
                                    <th>Gender</th>
                                    <th>Position</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT *, UPPER(CONCAT(firstname,' ',lastname)) AS official_name FROM tbl_official ORDER BY official_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                       
                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['official_name'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['address'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['email'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['contact_no'].'</label></td>';
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.$u_row['gender'].'</label></td>';
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.$u_row['position'].'</label></td>';
                                            echo'<td>';
                                            echo'<a href="#edit'.$u_row['official_id'].'" data-toggle="modal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit </a>';
                                                echo'<a href="#remove'.$u_row['official_id'].'" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
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
    $jselect  = "SELECT * FROM tbl_official ORDER BY official_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>

<div class="modal fade" id="edit<?php echo $jrow['official_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/modify.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-user"></i> Edit Official Profile</h5>
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
                        <select name="position" class="form-control">
                                        <option value="">Select Position</option>
                                        <option value="Grade 1">Grade 1</option>
                                        <option value="Grade 2">Grade 2</option>
                                        <option value="Grade 3">Grade 3</option>
                                        <option value="Grade 4">Grade 4</option>
                                        <option value="Grade 5">Grade 5</option>
                                        <option value="Grade 6">Grade 6</option>
                                        <option value="Kinder Adviser">Kinder Adviser</option>
                                        <option value="School Principal">School Principal</option>
                                        <option value="School Guard">SCHOOL GUARD</option>
                                    </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="offiicialID" value="<?php echo $jrow['official_id']?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="modify_official<?php echo $jrow['official_id']?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit Save</button> 
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="remove<?php echo $jrow['official_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label>Are you sure you want to delete?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?official_id=<?php echo $jrow['official_id']?>&confirm=19" class="btn btn-success"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php
    }
?>