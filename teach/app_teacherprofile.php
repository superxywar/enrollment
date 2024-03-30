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
                    
                    <p class="text-muted text-center">
                        <a href="#profile<?php echo $_SESSION['teach_id']?>" data-toggle="modal" style="text-align:center; font-size:12px; color:#000;">Edit Profile Picture</a><br>
                        Teacher
                    </p>
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
                
                <div class="card-header" style="background-color:#343a40;">
                    <h3 class="card-title" style="font-size:16px; color:#FFF;"><i class="nav-icon fas fa-user-alt"></i>&nbsp;&nbsp;Personal Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name :</label>
                                    <label style="font-weight:normal; text-transform:capitalize;"><?php echo $t_row['firstname'].' '.$t_row['lastname']?></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address :</label>
                                    <label style="font-weight:normal; text-transform:capitalize;"><?php echo $t_row['address']?></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gender :</label>
                                    <label style="font-weight:normal; text-transform:capitalize;"><?php echo $t_row['gender']?></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Civil Status :</label>
                                    <label style="font-weight:normal; text-transform:capitalize;"><?php echo $t_row['civil_status']?></label>
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
                                    <label style="font-weight:normal;"><?php echo $t_row['email']?></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact No. :</label>
                                    <label style="font-weight:normal; text-transform:capitalize;"><?php echo $t_row['contact_no']?></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password :</label>
                                    <label style="font-weight:normal; "><?php echo $t_row['password']?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header" style="background-color:#343a40;">
                        <h3 class="card-title" style="font-size:16px; color:#FFF;"><i class="nav-icon fas fa-book"></i>&nbsp;&nbsp;Educational Background</h3>
                    </div>
                    <div class="card-body">
                        <div class="row" style="line-height:4.5px;">
                            <?php
                                $g_sel = "SELECT * FROM tbl_teacheduc WHERE teach_id=:teach_id ORDER BY level ASC";
                                $g_sele= $db->prepare($g_sel);
                                $g_sele->bindParam(':teach_id',$_SESSION['teach_id']);
                                $g_sele->execute();
                                while($g_row=$g_sele->fetch()){
                                    echo'<div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Level :</label>
                                            <label style="font-weight:normal;">'.$g_row['level_school'].'</label>
                                        </div>
                                    </div>';
                                    echo'<div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Year Graduated :</label>
                                            <label style="font-weight:normal; text-transform:capitalize;">'.$g_row['year_graduated'].'</label>
                                        </div>
                                    </div>';
                                    echo'<div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name of School:</label>
                                            <label style="font-weight:normal; text-transform:capitalize;">'.$g_row['name_school'].'</label>
                                        </div>
                                    </div>';

                                    if($g_row['degree']==''){}
                                    else{
                                        echo'<div class="col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Degree</label>
                                                <label style="font-weight:normal; text-transform:capitalize;">'.$g_row['degree'].'</label>
                                            </div>
                                        </div>'; 
                                    }
                                }
                            ?>
                            
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" style="line-height:4.5px;">
                            
                            
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Eligibility</th>
                                    <th>Rating</th>
                                    <th>Date of Examination</th>
                                    <th>Place of Examination</th>
                                    <th>License No.</th>
                                    <th>Date of validity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_teacheli WHERE teach_id=:teach_id ORDER BY teacheli_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->bindParam(':teach_id',$_SESSION['teach_id']);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['eligibility'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['rating'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.date("F j, Y", strtotime($u_row['date_exam'])).'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['place'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['license_number'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['date_validity'].'</label></td>';
                                        echo'</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                            
                            
                        </div>
                    <div class="card-footer">
                        <!-- <a href="index.php?page=app_teachereduc" class="btn btn-primary" style="float:right; margin-left:5px;"><i class="nav-icon fas fa-check"></i>&nbsp;Update Educational Background</a> -->
                        <a href="index.php?page=app_teacher" class="btn btn-primary" style="float:right; "><i class="nav-icon fas fa-check"></i>&nbsp;Update Profile</a>
                    </div>
                    <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<?php
    $jselect  = "SELECT * FROM tbl_teacher WHERE teach_id=:teach_id";
    $jquery   =   $db->prepare($jselect);
    $jquery->bindParam(':teach_id',$_SESSION['teach_id']);
    $jquery->execute();
    while($jrow=$jquery->fetch()){

        
    
?>
<div class="modal fade" id="profile<?php echo $jrow['teach_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/modify.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list"></i> Update Profile Picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    
                    <div class="form-group">
                        <label>Photo :</label>
                        <input type="file" class="form-control" autocomplete="off" name="file" required="required" >
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="teachID" value="<?php echo $_SESSION['teach_id']?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="modify_pic<?php echo $jrow['teach_id']?>" class="btn btn-info"><i class="fas fa-edit"></i> Update Profile Pic</button> 
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