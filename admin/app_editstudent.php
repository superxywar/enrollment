<?php
    require_once'../../resources/script_updatestudent.php';

    $s_sel = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
    $s_sele= $db->prepare($s_sel);
    $s_sele->bindParam(':stud_id',$_GET['stud_id']);
    $s_sele->execute();
    $s_row = $s_sele->fetch();
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-user-alt"></i>&nbsp;&nbsp;Student Profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h3 style="font-size:16px;">Note : Thus has a <span style="color:red;">*</span> are required fields.</h3>
                                    <h5>Student Information :</h5>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">PSA Birth Certificate No. :</label>
                                    <input value="<?php echo $s_row['psa_no']?>" type="number" class="form-control" autocomplete="off" name="psa" placeholder="Input PSA Birth Certificate No.">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">LRN Number :</label>
                                    <input value="<?php echo $s_row['lrn_number']?>" type="number" class="form-control" autocomplete="off" name="lrn" placeholder="Input LRN Number">
                                </div>
                            </div>
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Firstname :</label>
                                    <input value="<?php echo $s_row['firstname']?>" type="text" class="form-control" autocomplete="off" name="firstname" placeholder="Input Firstname" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Lastname :</label>
                                    <input value="<?php echo $s_row['lastname']?>" type="text" class="form-control" autocomplete="off" name="lastname" placeholder="Input Lastname" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Middlename :</label>
                                    <input value="<?php echo $s_row['middlename']?>" type="text" class="form-control" autocomplete="off" name="middlename" placeholder="Input Middlename"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Extension Name : eg Jr., III (if applicable)</label>
                                    <input value="<?php echo $s_row['ext_name']?>" type="text" class="form-control" autocomplete="off" name="ext_name" placeholder="Input Extension Name : eg Jr., III (if applicable)" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Birth Date:</label>
                                    <input value="<?php echo $s_row['birth_date']?>" type="date" class="form-control" name="birth_date" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="<?php echo $s_row['gender']?>"><?php echo $s_row['gender']?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Address</label>
                                    <input value="<?php echo $s_row['address']?>" type="text" class="form-control" autocomplete="off" name="address" placeholder="Enter Address" required="required" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Religion</label>
                                    <select name="religion" class="form-control" required>
                                        <option value="<?php echo $s_row['religion']?>"><?php echo $s_row['religion']?></option>
                                        <option value="Roman Catholic">Roman Catholic</option>
                                        <option value="Iglesia Ni Cristo">Iglesia Ni Cristo</option>
                                        <option value="Protestant">Protestant</option>
                                        <option value="Aglipayan">Aglipayan</option>
                                        <option value="Seventh Day Adventist">Seventh Day Adventist</option>
                                        <option value="Baptist">Baptist</option>
                                        <option value="United Church of Christ in th Philippines">United Church of Christ in th Philippines</option>
                                        <option value="Jehovah">Jehovah</option>
                                        <option value="Islam">Islam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Mother Tongue :</label>
                                    <input value="<?php echo $s_row['mother_tongue']?>" type="text" class="form-control" autocomplete="off" name="mother_tongue" placeholder="Input Mother Tongue" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Tribe :</label>
                                    <input value="<?php echo $s_row['tribe']?>" type="text" class="form-control" autocomplete="off" name="tribe" placeholder="Input Tribe" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h5>Parent's/ Guardian's Information :</h5>
                                    <hr>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Father Name</label>
                                    <input value="<?php echo $s_row['father_name']?>" type="text" class="form-control" autocomplete="off" name="father_name" placeholder="Input Father Name" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Contact No.</label>
                                    <input value="<?php echo $s_row['father_contact']?>" type="number" class="form-control" name="father_contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Input Contact No." autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>E-mail :</label>
                                    <input value="<?php echo $s_row['father_email']?>" type="email" class="form-control" name="father_email"  placeholder="Input E-mail" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Mother Name</label>
                                    <input value="<?php echo $s_row['mother_name']?>" type="text" class="form-control" autocomplete="off" name="mother_name" placeholder="Enter Mother Name" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Contact No.</label>
                                    <input value="<?php echo $s_row['mother_contact']?>" type="number" class="form-control" name="mother_contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Enter Contact No." autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>E-mail :</label>
                                    <input value="<?php echo $s_row['mother_email']?>" type="email" class="form-control" name="mother_email"  placeholder="Input E-mail" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Guardian Name</label>
                                    <input value="<?php echo $s_row['guardian_name']?>" type="text" class="form-control" autocomplete="off" name="guardian_name" placeholder="Enter Guardian Name" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>E-mail :</label>
                                    <input value="<?php echo $s_row['guardian_email']?>" type="email" class="form-control" name="guardian_email"  placeholder="Input E-mail" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Contact No.</label>
                                    <input value="<?php echo $s_row['guardian_contact']?>" type="number" class="form-control" name="guardian_contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Enter Contact No." autocomplete="off" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" name="student_no" value="<?php echo $student_no?>">
                        <button type="submit" class="btn btn-primary" name="btn_save" style="float:right;"><i class="nav-icon fas fa-check"></i>&nbsp;Update Student Profile</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
