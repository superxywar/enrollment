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
            <!-- left column -->
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header" style="background-color:#343a40;">
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Student Record</h3>
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
<?php        
    }
    
?>