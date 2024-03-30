<?php
    
    require_once'../../resources/message.php';
    $stud_id = $_GET['stud_id'];

    $s_sel   = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
    $s_sele  = $db->prepare($s_sel);
    $s_sele  ->bindParam(':stud_id',$_GET['stud_id']);
    $s_sele  ->execute();
    $s_row   = $s_sele->fetch();
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
                                    <label for="exampleInputEmail1">STUDENT NO. : </label>
                                    <label style="font-weight:normal;"><?php echo $s_row['stud_no']?></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">LRN NUMBER :</label>
                                    <label style="font-weight:normal;"><?php echo $s_row['lrn_number']?></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">STUDENT NAME :</label>
                                    <label style="font-weight:normal;"><?php echo $s_row['firstname'].' '.$s_row['lastname']?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Payment</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">School Year</th>
                                    <th style="font-size: 12px;">Payment</th>
                                    <th style="font-size: 12px;">Amount Pay</th>
                                    <th style="font-size: 12px;">Balance</th>
                                    <th style="font-size: 12px;">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $bal           = 0;
                                $total_payment = 0;
                                $total_pay     = 0;
                                $total_balance = 0;

                                $sel_query ="SELECT sy_id, SUM(amount) AS amount FROM tbl_studentpayment WHERE stud_id=:stud_id GROUP BY sy_id ORDER BY sy_id DESC";
                                $select_query =$db->prepare($sel_query);
                                $select_query->bindParam(':stud_id',$_GET['stud_id']);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){

                                    $g_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
                                    $g_sele= $db->prepare($g_sel);
                                    $g_sele->bindParam(':sy_id',$row_sel['sy_id']);
                                    $g_sele->execute();
                                    $g_row = $g_sele->fetch();

                                     //payment transacted
                                    $o_sel = "SELECT SUM(amount) AS payment FROM tbl_studentpay WHERE sy_id=:sy_id AND stud_id=:stud_id";
                                    $o_sele= $db->prepare($o_sel);
                                    $o_sele->bindParam(':sy_id',$row_sel['sy_id']);
                                    $o_sele->bindParam(':stud_id',$_GET['stud_id']);
                                    $o_sele->execute();
                                    if($o_sele->rowCount()>=1){
                                        $o_row = $o_sele->fetch();
                                        $payment = $o_row['payment'];
                                    }
                                    else{
                                        $payment = 0;
                                    }

                                    $bal = $row_sel['amount'] - $payment;
                                    if($bal<=0){
                                        $bal = 0;
                                    }
                                    else{
                                        $bal = $row_sel['amount'] - $payment;
                                    }

                                    echo'<tr>';
                                        echo'<td>'.$g_row['start_year'].' - '.$g_row['end_year'].'</td>'; 
                                        echo'<td>Php '.number_format($row_sel['amount'], 2, '.', ',').'</td>';
                                        echo'<td>Php '.number_format($payment, 2, '.', ',').'</td>';
                                        echo'<td>Php '.number_format($bal, 2, '.', ',').'</td>';
                                        echo'<td><a href="index.php?page=app_listpayments&sy_id='.$row_sel['sy_id'].'&stud_id='.$_GET['stud_id'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View Payment</a></td>';
                                    echo'</tr>';

                                    $total_payment = $total_payment + $row_sel['amount'];
                                    $total_pay     = $total_pay     + $payment;
                                    $total_balance = $total_balance + $bal;
                                }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><label style="float:right;">Grand Total Payment :</label></td>
                                    <td><label><?php echo'Php '.number_format($total_payment, 2, '.', ',')?></label></td>
                                    <td><label><?php echo'Php '.number_format($total_pay, 2, '.', ',')?></label></td>
                                    <td><label><?php echo'Php '.number_format($total_balance, 2, '.', ',')?></label></td>
                                    <td></td>
                                </tr>
                            </tfoot>
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
