<?php
    
    require_once'../../resources/message.php';
    $stud_id = $_GET['stud_id'];

    $s_sel   = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
    $s_sele  = $db->prepare($s_sel);
    $s_sele  ->bindParam(':stud_id',$_GET['stud_id']);
    $s_sele  ->execute();
    $s_row   = $s_sele->fetch();

    $t_sel   = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $t_sele  = $db->prepare($t_sel);
    $t_sele  ->bindParam(':sy_id',$_GET['sy_id']);
    $t_sele  ->execute();
    $t_row   = $t_sele->fetch();
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
                        <h3 class="card-title">Payment for School Year : <?php echo $t_row['start_year'].' - '.$t_row['end_year'];?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">Fee</th>
                                    <th style="font-size: 12px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $total = 0;
                                $bal   = 0;
                                $sel_query ="SELECT * FROM tbl_studentpayment WHERE sy_id=:sy_id AND stud_id=:stud_id ORDER BY sy_id DESC";
                                $select_query =$db->prepare($sel_query);
                                $select_query->bindParam(':sy_id',$_GET['sy_id']);
                                $select_query->bindParam(':stud_id',$_GET['stud_id']);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){

                                    $g_sel = "SELECT * FROM tbl_fee WHERE fee_id=:fee_id";
                                    $g_sele= $db->prepare($g_sel);
                                    $g_sele->bindParam(':fee_id',$row_sel['fee_id']);
                                    $g_sele->execute();
                                    $g_row = $g_sele->fetch();

                                    echo'<tr>';
                                        echo'<td>'.$g_row['fee'].'</td>'; 
                                        echo'<td>Php '.number_format($row_sel['amount'], 2, '.', ',').'</td>';
                                    echo'</tr>';
                                    $total = $total + $row_sel['amount'];
                                }

                                //payment transacted

                                $o_sel = "SELECT SUM(amount) AS payment FROM tbl_studentpay WHERE sy_id=:sy_id AND stud_id=:stud_id";
                                $o_sele= $db->prepare($o_sel);
                                $o_sele->bindParam(':sy_id',$_GET['sy_id']);
                                $o_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $o_sele->execute();
                                if($o_sele->rowCount()>=1){
                                    $o_row = $o_sele->fetch();
                                    $payment = $o_row['payment'];
                                }
                                else{
                                    $payment = 0;
                                }
                                $bal = $total - $payment;
                                if($bal<=0){
                                    $bal = 0;
                                }
                                else{
                                    $bal = $total - $payment;
                                }
                                
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><label style="float:right;">Total Payment :</label></td>
                                    <td><label><?php echo'Php '.number_format($total, 2, '.', ',')?></label></td>
                                </tr>
                                <tr>
                                    <td><label style="float:right;">Total Amound Paid :</label></td>
                                    <td><label><?php echo'Php '.number_format($payment, 2, '.', ',')?></label></td>
                                </tr>
                                <tr>
                                    <td><label style="float:right;">Balance :</label></td>
                                    <td><label><?php echo'Php '.number_format($bal, 2, '.', ',')?></label></td>
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


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Payment for School Year : <?php echo $t_row['start_year'].' - '.$t_row['end_year'];?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">Date</th>
                                    <th style="font-size: 12px;">O.R. No.</th>
                                    <th style="font-size: 12px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $ptotal = 0;
                                
                                $sel_query ="SELECT * FROM tbl_studentpay WHERE sy_id=:sy_id AND stud_id=:stud_id ORDER BY date DESC";
                                $select_query =$db->prepare($sel_query);
                                $select_query->bindParam(':sy_id',$_GET['sy_id']);
                                $select_query->bindParam(':stud_id',$_GET['stud_id']);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){

                                    echo'<tr>';
                                        echo'<td>'.date("F j, Y", strtotime($row_sel['date'])).'</td>'; 
                                        echo'<td>'.$row_sel['or_no'].'</td>'; 
                                        echo'<td>Php '.number_format($row_sel['amount'], 2, '.', ',').'</td>';
                                    echo'</tr>';
                                    $ptotal = $ptotal + $row_sel['amount'];
                                }

                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><label style="float:right;">Total Payment :</label></td>
                                    <td><label><?php echo'Php '.number_format($ptotal, 2, '.', ',')?></label></td>
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
<?php
    require_once'../../resources/script_orno.php';
?>
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/script_payment.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list"></i> Payment Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>O.R. Number :</label>
                        <input type="text" class="form-control" readonly value="<?php echo $orno?>" autocomplete="off" name="ornumber" required="required" placeholder="Input O.R. Number">
                    </div>
                    <div class="form-group">
                        <label>Payee Name :</label>
                        <input type="text" class="form-control"  autocomplete="off" name="name" placeholder="Input Payee Name" required="required" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
                    </div>
                    <div class="form-group">
                        <label>Description of Payment :</label>
                        <input type="text" class="form-control"  autocomplete="off" name="particular" placeholder="Input Description of Payment" required="required" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
                    </div>
                    <div class="form-group">
                        <label>Amount Pay :</label>
                        <input type="number" class="form-control" readonly value="<?php echo $bal;?>"  autocomplete="off" name="amount" placeholder="Input Amount to Pay" required="required" >
                    </div>
                    <div class="form-group">
                        <label>Cash :</label>
                        <input type="number" class="form-control"  autocomplete="off" name="cash" placeholder="Input Cash" required="required" >
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="bal" value="<?php echo $bal?>" />
                    <input type="hidden" name="sy_id" value="<?php echo $_GET['sy_id']?>" />
                    <input type="hidden" name="stud_id" value="<?php echo $_GET['stud_id']?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_submit" class="btn btn-info"><i class="fas fa-check"></i> Submit</button> 
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>