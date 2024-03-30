<?php
    require_once'../../resources/script_updatestudents.php';
    //require_once'../../resources/message.php';
    if(isset($_SESSION['msf'])){
        $message = $_SESSION['msf'];
        if($message==1){
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Data successfully modify.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
        }
    }
    $t_sel = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
    $t_sele= $db->prepare($t_sel);
    $t_sele->bindParam(':stud_id',$_SESSION['stud_id']);
    $t_sele->execute();
    $t_row = $t_sele->fetch();

?>
<style type="text/css">
    #bordered {
        border-color:red;
    }
</style>
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
                                    <h5>Student Information :</h5>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">PSA Birth Certificate No. :</label>
                                    <?php
                                        if($t_row['psa_no']==''){
                                            echo'<input type="number" class="form-control" autocomplete="off" name="psa" id="bordered" placeholder="Input PSA Birth Certificate No.">';
                                        }
                                        else{
                                            echo'<input type="number" class="form-control" autocomplete="off" name="psa" value="'.$t_row['psa_no'].'" placeholder="Input PSA Birth Certificate No.">';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">LRN Number :</label>
                                    <?php
                                        if($t_row['lrn_number']==''){
                                            echo'<input type="number" id="bordered" class="form-control" autocomplete="off" name="lrn" placeholder="Input LRN Number" required="required">';
                                        }
                                        else{
                                            echo'<input type="number" class="form-control" autocomplete="off" name="lrn" value="'.$t_row['lrn_number'].'" placeholder="Input LRN Number" required="required">';
                                        }
                                    ?>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Firstname :</label>
                                    <input type="text" class="form-control" autocomplete="off" name="firstname" value="<?php echo $t_row['firstname']?>" placeholder="Input Firstname" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lastname :</label>
                                    <input type="text" class="form-control" autocomplete="off" name="lastname" value="<?php echo $t_row['lastname']?>" placeholder="Input Lastname" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Middlename :</label>
                                    <input type="text" class="form-control" autocomplete="off" name="middlename" value="<?php echo $t_row['middlename']?>" placeholder="Input Middlename"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                    
                                    
                                </div>
                            </div>
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Extension Name : eg Jr., III (if applicable)</label>
                                    <input type="text" class="form-control" autocomplete="off" name="ext_name" value="<?php echo $t_row['ext_name']?>" placeholder="Input Extension Name : eg Jr., III (if applicable)" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Birth Date:</label>
                                    <?php
                                        if($t_row['birth_date']==''){
                                            echo'<input type="date" class="form-control" name="birth_date" id="bordered" required autocomplete="off">';
                                        }
                                        else{
                                            echo'<input type="date" class="form-control" name="birth_date" value="'.$t_row['birth_date'].'" required autocomplete="off">';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gender</label>
                                    <?php
                                        if($t_row['gender']==''){

                                            echo'<select name="gender" class="form-control" id="bordered" required>
                                                <option value="'.$t_row['gender'].'">'.$t_row['gender'].'</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>';
                                        }
                                        else{
                                            echo'<select name="gender" class="form-control" required>
                                                <option value="'.$t_row['gender'].'">'.$t_row['gender'].'</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>';
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <?php
                                        if($t_row['address']==''){
                                            echo'<input type="text" class="form-control" autocomplete="off" name="address" id="bordered" placeholder="Enter Address" required="required" >';
                                        }
                                        else{
                                            echo'<input type="text" class="form-control" autocomplete="off" name="address" value="'.$t_row['address'].'" placeholder="Enter Address" required="required" >';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Religion</label>
                                    <?php
                                        if($t_row['religion']==''){
                                            echo'
                                            <select name="religion" id="bordered" class="form-control" required>
                                                <option value="'.$t_row['address'].'">'.$t_row['address'].'</option>
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
                                            ';        
                                        }
                                        else{
                                    ?>
                                    <select name="religion" class="form-control" required>
                                        <option value="<?php echo $t_row['religion']?>"><?php echo $t_row['religion']?></option>
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
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mother Tongue :</label>
                                    <?php
                                        if($t_row['mother_tongue']==''){
                                            echo'<input type="text" class="form-control" autocomplete="off" id="bordered" name="mother_tongue" placeholder="Input Mother Tongue" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">';
                                        }
                                        else{
                                            echo'<input type="text" class="form-control" autocomplete="off" value="'.$t_row['mother_tongue'].'" name="mother_tongue" placeholder="Input Mother Tongue" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tribe :</label>
                                    <?php
                                        if($t_row['tribe']==''){
                                            echo'<input type="text" class="form-control" autocomplete="off" name="tribe" id="bordered" placeholder="Input Tribe" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">';
                                        }
                                        else{
                                            echo'<input type="text" class="form-control" autocomplete="off" name="tribe" value="'.$t_row['tribe'].'" placeholder="Input Tribe" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">';
                                        }
                                    ?>
                                    
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
                                    <label for="exampleInputEmail1">Father Name</label>
                                    <?php
                                        if($t_row['father_name']==''){
                                            echo'<input type="text" class="form-control" autocomplete="off" id="bordered" name="father_name" placeholder="Input Father Name" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">';
                                        }
                                        else{
                                            echo'<input type="text" class="form-control" autocomplete="off" value="'.$t_row['father_name'].'" name="father_name" placeholder="Input Father Name" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">';
                                        }
                                        
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact No.</label>
                                    <?php
                                        if($t_row['father_contact']==''){
                                            echo'<input type="number" class="form-control" name="father_contact" id="bordered" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Input Contact No." autocomplete="off" required="required">';
                                        }
                                        else{
                                            echo'<input type="number" class="form-control" name="father_contact" value="'.$t_row['father_contact'].'" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Input Contact No." autocomplete="off" required="required">';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail :</label>
                                    <?php
                                        if($t_row['father_email']==''){
                                            echo'<input type="email" class="form-control" name="father_email" id="bordered"  placeholder="Input E-mail" autocomplete="off" required="required">';
                                        }
                                        else{
                                            echo'<input type="email" class="form-control" name="father_email" value="'.$t_row['father_email'].'"  placeholder="Input E-mail" autocomplete="off" required="required">';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mother Name</label>
                                    <?php
                                        if($t_row['mother_name']==''){
                                            echo'<input type="text" class="form-control" autocomplete="off" id="bordered" name="mother_name" placeholder="Enter Mother Name" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">';
                                        }
                                        else{
                                            echo'<input type="text" class="form-control" autocomplete="off" value="'.$t_row['mother_name'].'" name="mother_name" placeholder="Enter Mother Name" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact No.</label>
                                    <?php
                                        if($t_row['mother_contact']==''){
                                            echo'<input type="number" class="form-control" name="mother_contact" id="bordered" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Enter Contact No." autocomplete="off" required="required">';
                                        }
                                        else{
                                            echo'<input type="number" class="form-control" name="mother_contact" value="'.$t_row['mother_contact'].'" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Enter Contact No." autocomplete="off" required="required">';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail :</label>
                                    <?php
                                        if($t_row['mother_email']==''){
                                            echo'<input type="email" class="form-control" name="mother_email" id="bordered"  placeholder="Input E-mail" autocomplete="off" required="required">';
                                        }
                                        else{
                                            echo'<input type="email" class="form-control" name="mother_email" value="'.$t_row['mother_email'].'"  placeholder="Input E-mail" autocomplete="off" required="required">';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Guardian Name</label>
                                    <input type="text" class="form-control" autocomplete="off" name="guardian_name" value="<?php echo $t_row['guardian_name']?>" placeholder="Enter Guardian Name" required="required" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                </div>
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact No.</label>
                                    <input type="number" class="form-control" name="guardian_contact" value="<?php echo $t_row['guardian_contact']?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Enter Contact No." autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail :</label>
                                    <input type="email" class="form-control" name="guardian_email" value="<?php echo $t_row['guardian_email']?>"  placeholder="Input E-mail" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password :</label>
                                    <input type="text" class="form-control" name="password" value="<?php echo $t_row['password']?>"  placeholder="Input Password" autocomplete="off" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" name="student_no" value="<?php echo $student_no?>">
                        <button type="submit" class="btn btn-primary" name="btn_save" style="float:right;"><i class="nav-icon fas fa-edit"></i>&nbsp;Update Student Profile</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
