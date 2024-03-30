<?php
    
    
    require_once'../../resources/script_updateeduteacher.php';
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
                    <form method="post" enctype="multipart/form-data">
                    <div class="card-header" style="background-color:#343a40;">
                        <h3 class="card-title" style="font-size:16px; color:#FFF;"><i class="nav-icon fas fa-book"></i>&nbsp;&nbsp;Educational Background</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Level of Study :</label>
                                        <select name="level" id="sel" required class="form-control" required>
                                            <option value="">Select Level of Study</option>
                                            <option value="Primary">Primary / Elementary</option>
                                            <option value="Secondary">Secondary</option>
                                            <option value="Tertiary">Tertiary / College</option>
                                            <option value="Vocational">Vocational Course</option>
                                            <option value="Master">Graduate Studies</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Year Graduated :</label>
                                        <input type="number" class="form-control"  name="year"  required placeholder="Input Year Graduated" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name of School :</label>
                                        <input type="text" class="form-control" name="name" required placeholder="Input Name of School" autocomplete="off"  required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Course / Degree (Note : this is intended for Tertiary/ Vocational Course/ Graduate Studies):</label>
                                        <input type="text" class="form-control" id="text" name="degree" required placeholder="Input Degree" autocomplete="off"  >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="hidden" name="teach_id" value="<?php echo $_GET['teach_id']?>">
                            <button type="submit" class="btn btn-primary" name="btn_save" style="float:right;"><i class="nav-icon fas fa-plus"></i>&nbsp;Add Education Background</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-book"></i>&nbsp;List of Education Background</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>Year Graduated</th>
                                    <th>Name of School</th>
                                    <th>Course / Degree</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_teacheduc WHERE teach_id=:teach_id ORDER BY teachedu_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->bindParam(':teach_id',$_GET['teach_id']);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['level_school'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['year_graduated'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['name_school'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['degree'].'</label></td>';
                                            echo'<td>';
                                                echo'<a href="#delete'.$u_row['teachedu_id'].'" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fas fa-remove"></i> Remove </a>';
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
        
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <form method="post" enctype="multipart/form-data">
                    <div class="card-header" style="background-color:#343a40;">
                        <h3 class="card-title" style="font-size:16px; color:#FFF;"><i class="nav-icon fas fa-book"></i>&nbsp;&nbsp;Eligibility</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Eligibility :</label>
                                        <input type="text" class="form-control" name="name" required placeholder="Input Eligibility" autocomplete="off"  required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Rating :</label>
                                        <input type="text" class="form-control" onkeypress="return (event.charCode > 46 && event.charCode <= 57) || (event.charCode==46)"  name="rating" required placeholder="Input Rating" autocomplete="off"  required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date of Examination :</label>
                                        <input type="date" class="form-control"  name="date_exam"  required placeholder="Input Year Graduated" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Place of Examination:</label>
                                        <input type="text" class="form-control" name="place" required placeholder="Input Place of Examination" autocomplete="off"  required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">License No. :</label>
                                        <input type="text" class="form-control" name="license"  placeholder="Input License No." autocomplete="off" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date of validity :</label>
                                        <input type="date" class="form-control"  name="date_valid"   placeholder="Input Year Graduated" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="hidden" name="teach_id" value="<?php echo $_GET['teach_id']?>">
                            <button type="submit" class="btn btn-primary" name="btn_saves" style="float:right;"><i class="nav-icon fas fa-plus"></i>&nbsp;Add Eligibility</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-book"></i>&nbsp;List of Eligibility</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Eligibility</th>
                                    <th>Rating</th>
                                    <th>Date of Examination</th>
                                    <th>Place of Examination</th>
                                    <th>License No.</th>
                                    <th>Date of validity</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_teacheli WHERE teach_id=:teach_id ORDER BY teacheli_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->bindParam(':teach_id',$_GET['teach_id']);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['eligibility'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['rating'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.date("F j, Y", strtotime($u_row['date_exam'])).'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['place'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['license_number'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['date_validity'].'</label></td>';
                                            echo'<td>';
                                                echo'<a href="#delete'.$u_row['teacheli_id'].'" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fas fa-remove"></i> Remove </a>';
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
    $jselect  = "SELECT * FROM tbl_teacheduc ORDER BY teachedu_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="delete<?php echo $jrow['teachedu_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <a href="../../resources/delete.php?teachedu_id=<?php echo $jrow['teachedu_id']?>&confirm=16&teach_id=<?php echo $_GET['teach_id']?>" class="btn btn-danger"><i class="fas fa-trash"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>
<?php
    $jselect  = "SELECT * FROM tbl_teacheli WHERE teach_id=:teach_id ORDER BY teacheli_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->bindParam(':teach_id',$_GET['teach_id']);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="delete<?php echo $jrow['teacheli_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <a href="../../resources/delete.php?teacheli_id=<?php echo $jrow['teacheli_id']?>&confirm=18&teach_id=<?php echo $_GET['teach_id']?>" class="btn btn-danger"><i class="fas fa-trash"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>
<script type="text/javascript">
    var sel = document.getElementById("sel"), text = document.getElementById("text");

    sel.onchange = function(e) {
    text.disabled = (sel.value == "Primary")||(sel.value == "Secondary");
    };
</script>