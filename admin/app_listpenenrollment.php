<?php
    require_once'../../resources/message.php';
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2"></div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-list"></i>&nbsp;List of Pending Application this school year</h3>
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
                                $sel_query ="SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND section_id!=0 AND stat_enroll='Pending Application' ORDER BY enroll_id DESC";
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
                                        echo'<td>'.$s_row['firstname'].' '.$s_row['lastname'].' '.$s_row['middlename'].'</td>';
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
                                                echo'<a href="print.php?page=print_subject&enroll_id='.$row_sel['enroll_id'].'" class="btn btn-info btn-sm"><i class="fa fa-search"></i> View Subject Load</a>&nbsp;';
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
    $jselect  = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stat_enroll='Pending Application' ORDER BY enroll_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->bindParam(':sy_id',$_SESSION['sy_id']);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>
<div class="modal fade" id="approved<?php echo $jrow['enroll_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list"></i> System Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure want to approved this application. This application will become a PRE-ENROLL application?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a class="btn btn-danger" style="text-decoration:none;" href="../../resources/delete.php?enroll_id=<?php echo $jrow['enroll_id']?>&confirm=15">Confirm this action</a>
                </div>
            </div>
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="disapproved<?php echo $jrow['enroll_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list"></i> System Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to disapproved this application?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" style="text-decoration:none;" href="../../resources/delete.php?enroll_id=<?php echo $jrow['enroll_id']?>&confirm=14">Confirm this action</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>