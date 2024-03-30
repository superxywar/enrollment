<?php
    require_once'../../resources/script_fee.php';
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
                        <h3 class="card-title"><i class="nav-icon fas fa-list"></i>&nbsp;List of Students</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">Student No.</th>
                                    <th style="font-size: 12px;">Student Name</th>
                                    <th style="font-size: 12px;">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sel_query ="SELECT DISTINCT grade_id, section_id FROM tbl_schedule WHERE sy_id=:sy_id AND teach_id=:teach_id ORDER BY sched_id DESC";
                                $select_query =$db->prepare($sel_query);
                                $select_query->bindParam(':sy_id',$_SESSION['sy_id']);
                                $select_query->bindParam(':teach_id',$_SESSION['teach_id']);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){
                                    
                                    $e_query = "SELECT enroll_id, stud_id FROM tbl_enroll WHERE grade_id=:grade_id AND section_id=:section_id";
                                    $e_querys= $db->prepare($e_query);
                                    $e_querys->bindParam(':grade_id',$row_sel['grade_id']);
                                    $e_querys->bindParam(':section_id',$row_sel['section_id']);
                                    $e_querys->execute();
                                    while($e_row   = $e_querys->fetch()){

                                    $s_sel = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
                                    $s_sele= $db->prepare($s_sel);
                                    $s_sele->bindParam(':stud_id',$e_row['stud_id']);
                                    $s_sele->execute();
                                    $s_row = $s_sele->fetch();

                                    
                                    echo'<tr>';
                                        echo'<td>'.$s_row['stud_no'].'</td>'; 
                                        echo'<td>'.$s_row['firstname'].' '.$s_row['middlename'].' '.$s_row['lastname'].'</td>';
                                        echo'<td style="width:350px;">';
                                            echo'<a href="prints.php?page=print_grade&enroll_id='.$e_row['enroll_id'].'" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Print Back Report Card</a>&nbsp;';
                                            echo'<a href="prints.php?page=print_frontgrade&enroll_id='.$e_row['enroll_id'].'" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Print Front Report Card</a>&nbsp;';
                                        echo'</td>'; 
                                    echo'</tr>';
                                    }
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