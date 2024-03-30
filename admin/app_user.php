<?php
    require_once'../../resources/script_user.php';
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-user-alt"></i>&nbsp;&nbsp;System User Account</h3>
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
                                    <label for="exampleInputEmail1">Password :</label>
                                    <input type="password" class="form-control" name="password"  required placeholder="Input Password" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Type :</label>
                                    <select name="user_type" class="form-control">
                                        <option value="">Select User Type</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Registrar">Registrar</option>
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
                        <h3 class="card-title"><i class="nav-icon fas fa-user-alt"></i>&nbsp;List of System User Account</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>E-mail</th>
                                    <th>Contact No.</th>
                                    <th>Password</th>
                                    <th>User Type</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT *, UPPER(CONCAT(firstname,' ',lastname)) AS user_name FROM tbl_useraccount ORDER BY user_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['user_name'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['email'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['contact_no'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['password'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['user_type'].'</label></td>';
                                            echo'<td>';
                                                if($u_row['user_type']=='Admin'){
                                                    echo'<a href="#edit'.$u_row['user_id'].'" data-toggle="modal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit User </a>';
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
    $jselect  = "SELECT * FROM tbl_useraccount ORDER BY user_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="edit<?php echo $jrow['user_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/modify.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-user"></i> Edit User Account</h5>
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
                        <label>Contact No. :</label>
                        <input type="tel" class="form-control" name="contact" value="<?php echo $jrow['contact_no']?>" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11"  onkeydown="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode >= 96 && event.keyCode <= 105" placeholder="Contact No.">
                    </div>
                    <div class="form-group">
                        <label>E - mail :</label>
                        <input type="email" class="form-control" autocomplete="off" name="email" value="<?php echo $jrow['email'];?>" required="required">
                    </div>
                    
                    <div class="form-group">
                        <label>Password :</label>
                        <input type="password" class="form-control" autocomplete="off" name="password" value="<?php echo $jrow['password'];?>" required="required">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userID" value="<?php echo $jrow['user_id']?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="modify_user<?php echo $jrow['user_id']?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit Save</button> 
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