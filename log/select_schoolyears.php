<?php
    if(isset($_POST['btn_select'])){
        $_SESSION['sy_id']  = $_POST['sy_id'];
        header('Location:../teach/');
    }
?>
<!-- /.login-logo -->
<div class="card card-outline card-primary" style="margin-top:-250px;">
    <div class="card-header text-center" style="height:100px;">
        <a href="../../" class="h4" style="color:#192655;"><b>IPIL SDA ONLINE ENROLLMENT SYSTEM</b></a><br>
        <p class="login-box-msg">SCHOOL YEAR SELECTION</p>
    </div>
    <div class="card-body">
        

        <form  method="post">
            <div class="input-group mb-6">
                <label>Select School Year :</label>
            </div>
            <div class="input-group mb-3">
                <select name="sy_id" class="form-control">
                    <option value="">Select Academic Year</option>
                    <?php
                        $s_sel = "SELECT * FROM tbl_schoolyear ORDER BY sy_id ASC";
                        $s_sele= $db->prepare($s_sel);
                        $s_sele->execute();
                        while($s_row=$s_sele->fetch()){
                            echo'<option value="'.$s_row['sy_id'].'">'.$s_row['start_year'].' - '.$s_row['end_year'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" name="btn_select" class="btn btn-primary btn-block">SELECT</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->