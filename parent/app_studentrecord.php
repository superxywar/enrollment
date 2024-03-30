<?php

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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student Record</h3>
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
                                $sel_query ="SELECT * FROM tbl_student WHERE stud_id=:stud_id ORDER BY stud_id DESC";
                                $select_query =$db->prepare($sel_query);
                                $select_query->bindParam(':stud_id',$_SESSION['stud_id']);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){

                                    echo'<tr>';
                                        echo'<td>'.$row_sel['stud_no'].'</td>'; 
                                        echo'<td>'.$row_sel['firstname'].' '.$row_sel['lastname'].' '.$row_sel['middlename'].'</td>';
                                        echo'<td>'.$row_sel['address'].'</td>'; 
                                        echo'<td>';
                                            echo'<a href="index.php?page=app_recordpayment&stud_id='.$row_sel['stud_id'].'" class="btn btn-info btn-sm" style="margin-right:5px;"><i class="fa fa-search"></i> View Payment Record</a>';
                                            echo'<a href="index.php?page=app_viewgrades&stud_id='.$row_sel['stud_id'].'" class="btn btn-info btn-sm"><i class="fa fa-search"></i> View Grades</a>';
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
