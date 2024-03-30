<?php
    
    require_once'../../resources/message.php';

    $t_sel = "SELECT * FROM tbl_teacher WHERE teach_id=:teach_id";
    $t_sele= $db->prepare($t_sel);
    $t_sele->bindParam(':teach_id',$_SESSION['teach_id']);
    $t_sele->execute();
    $t_row = $t_sele->fetch();
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
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline" style="border-top: solid 5px #343a40;">
                    <div class="card-body box-profile">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="../admin/images/<?php echo $t_row['photo']?>"
                            alt="User profile picture" style="width:150px; height:140px;">
                        </div>

                        <h3 class="profile-username text-center" style="text-transform:capitalize;"><?php echo $t_row['firstname'].' '.$t_row['lastname']?></h3>

                        <p class="text-muted text-center">Teacher</p>
                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Update Profile Picture</b></a> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="card card-primary">
                    <form method="post" action="../../resources/script_updateteachers.php" enctype="multipart/form-data">
                    <div class="card-header" style="background-color:#343a40;">
                        <h3 class="card-title" style="font-size:16px; color:#FFF;"><i class="nav-icon fas fa-user-alt"></i>&nbsp;&nbsp;Personal Information</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Firstname :</label>
                                        <input type="text" class="form-control" value="<?php echo $t_row['firstname']?>" name="firstname" required placeholder="Input Firstname" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lastname :</label>
                                        <input type="text" class="form-control" value="<?php echo $t_row['lastname']?>" name="lastname"  required placeholder="Input Lastname" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address :</label>
                                        <input type="text" class="form-control" value="<?php echo $t_row['address']?>" name="address" required placeholder="Input Address" autocomplete="off"  >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Gender :</label>
                                        <select name="gender" class="form-control">
                                            <option value="<?php echo $t_row['gender']?>"><?php echo $t_row['gender']?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Civil Status :</label>
                                        <select name="civil" class="form-control">
                                            <option value="<?php echo $t_row['civil_status']?>"><?php echo $t_row['civil_status']?></option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                            <option value="widowed">Widowed</option>
                                            <option value="separated">Separated</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header" style="background-color:#343a40;">
                            <h3 class="card-title" style="font-size:16px; color:#FFF;"><i class="nav-icon fas fa-book"></i>&nbsp;&nbsp;Contact and Login Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-mail :</label>
                                        <input type="email" class="form-control" value="<?php echo $t_row['email']?>" name="email" required placeholder="Input E-mail" autocomplete="off"  >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Contact No. :</label>
                                        <input type="tel" class="form-control" name="contact" value="<?php echo $t_row['contact_no']?>" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11"  onkeydown="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode >= 96 && event.keyCode <= 105" placeholder="Input Contact No.">
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password :</label>
                                        <input type="text" class="form-control" value="<?php echo $t_row['password']?>" name="password" required placeholder="Input Password" autocomplete="off"  >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="hidden" name="teach_id" value="<?php echo $_SESSION['teach_id']?>">
                            <button type="submit" class="btn btn-primary" name="btn_save" style="float:right;"><i class="nav-icon fas fa-check"></i>&nbsp;Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
