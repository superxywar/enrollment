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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Payment Module</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Search :</label>
                                    <input type="text" class="form-control" name="lastname" required placeholder="Input Lastname of the Student" autocomplete="off"  >
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="btn_search" style="float:right;"><i class="nav-icon fas fa-search"></i>&nbsp;Search</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<?php
    if(isset($_POST['btn_search'])){
        
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search Result "<b><?php echo strtoupper($_POST['lastname']);?></b>"</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">Student No.</th>
                                    <th style="font-size: 12px;">Student Name</th>
                                    <th style="font-size: 12px;">Address</th>
                                    <th style="font-size: 12px;">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sel_query ="SELECT * FROM tbl_student WHERE lastname LIKE '%".$_POST['lastname']."%' ORDER BY stud_id DESC";
                                $select_query =$db->prepare($sel_query);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){

                                    echo'<tr>';
                                        echo'<td>'.$row_sel['stud_no'].'</td>'; 
                                        echo'<td>'.$row_sel['firstname'].' '.$row_sel['middlename'].' '.$row_sel['lastname'].'</td>';
                                        echo'<td>'.$row_sel['address'].'</td>'; 
                                        echo'<td>';

                                            $y_sel = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stud_id=:stud_id";
                                            $y_sele= $db->prepare($y_sel);
                                            $y_sele->bindParam(':sy_id',$_SESSION['sy_id']);
                                            $y_sele->bindParam(':stud_id',$row_sel['stud_id']);
                                            $y_sele->execute();

                                            if($y_sele->rowCount()>=1){
                                                echo'<a href="index.php?page=app_listpayment&stud_id='.$row_sel['stud_id'].'" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> View List Payment</a>';
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
    }
    else{
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-list"></i>&nbsp;List of enrollee this school year</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">Student No.</th>
                                    <th style="font-size: 12px;">Student Name</th>
                                    <th style="font-size: 12px;">Grade & Section</th>
                                    <th style="font-size: 12px;">Student Status</th>
                                    <th style="font-size: 12px;">Enrollment Status</th>
                                    <th style="font-size: 12px;">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sel_query ="SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND section_id!=0 ORDER BY enroll_id DESC";
                                $select_query =$db->prepare($sel_query);
                                $select_query->bindParam(':sy_id',$_SESSION['sy_id']);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){
                                    
                                    $s_sel = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
                                    $s_sele= $db->prepare($s_sel);
                                    $s_sele->bindParam(':stud_id',$row_sel['stud_id']);
                                    $s_sele->execute();
                                    $s_row = $s_sele->fetch();

                                    $a_sel = "SELECT * FROM tbl_academic WHERE acad_id=:acad_id";
                                    $a_sele= $db->prepare($a_sel);
                                    $a_sele->bindParam(':acad_id',$row_sel['acad_id']);
                                    $a_sele->execute();
                                    $a_row = $a_sele->fetch();

                                    $g_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $g_sele= $db->prepare($g_sel);
                                    $g_sele->bindParam(':grade_id',$row_sel['grade_id']);
                                    $g_sele->execute();
                                    $g_row = $g_sele->fetch();

                                    if($row_sel['section_id']==0){
                                        $sections = 'TO BE ARRANGE';
                                    }
                                    else{
                                        $l_sel = "SELECT section FROM tbl_section WHERE section_id=:section_id";
                                        $l_sele= $db->prepare($l_sel);
                                        $l_sele->bindParam(':section_id',$row_sel['section_id']);
                                        $l_sele->execute();
                                        $l_row = $l_sele->fetch();

                                        $sections = $l_row['section'];
                                    }
                                    echo'<tr>';
                                        echo'<td>'.$s_row['stud_no'].'</td>'; 
                                        echo'<td>'.$s_row['firstname'].' '.$s_row['middlename'].' '.$s_row['lastname'].'</td>';
                                        echo'<td> '.$g_row['grade'].'-'.$sections.'</td>'; 
                                        echo'<td>'.$row_sel['status'].'</td>'; 

                                        if($row_sel['stat_enroll']==''){
                                            echo'<td><text class="text text-default">Not Finished</text></td>';   
                                        }
                                        elseif($row_sel['stat_enroll']=='Pending Application'){
                                            echo'<td><text class="text text-danger">Pending Application</text></td>';   
                                        }
                                        elseif($row_sel['stat_enroll']=='Disapproved Application'){
                                            echo'<td><text class="text text-default">Disapproved Application</text></td>';   
                                        }
                                        elseif($row_sel['stat_enroll']=='Approved Application'){
                                            echo'<td><text class="text text-success">Approved Application</text></td>';   
                                        }
                                        elseif($row_sel['stat_enroll']=='Pre-Enroll'){
                                            echo'<td><text class="text text-danger">Pre-Enroll</text></td>';   
                                        }
                                        else{
                                            echo'<td><text class="text text-success">Enrolled</text></td>';     
                                        }
                                        echo'<td>';
                                            if($row_sel['stat_enroll']==''){
                                                echo'<a href="index.php?page=form_listschedule&stud_id='.$row_sel['stud_id'].'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit to Finish </a>&nbsp;';
                                            
                                            }
                                            elseif($row_sel['stat_enroll']=='Pending Application'){
                                                echo'<a href="#approved'.$row_sel['enroll_id'].'" data-toggle="modal" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved </a>&nbsp;';
                                                echo'<a href="#disapproved'.$row_sel['enroll_id'].'" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-remove"></i> Disapproved </a>&nbsp;';
                                                
                                            }
                                            elseif($row_sel['stat_enroll']=='Disapproved Application'){
                                                //echo'<a href="#delete'.$row_sel['enroll_id'].'" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete </a>';
                                            }
                                            elseif($row_sel['stat_enroll']=='Approved Application'){
                                                echo'<a href="index.php?page=form_listschedule&stud_id='.$row_sel['stud_id'].'" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add Subject </a>&nbsp;';
                                                
                                            }
                                            else{
                                                //echo'<a href="#dropped'.$row_sel['enroll_id'].'" data-toggle="modal" class="btn bg-navy btn-sm"><i class="fa fa-arrow-down"></i> Drop </a>&nbsp;';
                                                echo'<a href="index.php?page=app_listpayment&stud_id='.$row_sel['stud_id'].'" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> View List Payment</a>';
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
    }
?>
?>