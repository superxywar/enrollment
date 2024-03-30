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
                        <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Create Payment</h3>
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
            
                    <div class="card-header" style="border-radius:0px; background-color:#343a40;">
                        <h3 class="card-title">Payment Transaction</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-4" style=" display:inline-block;">
                        <form method="post" action="../../resources/script_payment.php" >
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;" colspan="2">Summary of Payment</th>
                                </tr>
                                <tr>
                                    <th style="font-size: 12px;">Fee</th>
                                    <th style="font-size: 12px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                
                                $bal   = 0;
                                $fee   = 0;
                                $pay   = 0;

                                
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
                                    $fee   = sprintf('%0.2f',$row_sel['amount'] / 10);
                                    //$fee   = number_format($fee, 2, '.', '');

                                    $rel_query = "SELECT SUM(amount) AS payment FROM tbl_studentpaycon WHERE sy_id=:sy_id AND stud_id=:stud_id AND fee_id=:fee_id AND or_no!=''";
                                    $rel_select= $db->prepare($rel_query);
                                    $rel_select->bindParam(':sy_id',$_GET['sy_id']);
                                    $rel_select->bindParam(':stud_id',$_GET['stud_id']);
                                    $rel_select->bindParam(':fee_id',$g_row['fee_id']);
                                    $rel_select->execute();
                                    if($rel_select->rowCount()>=1){
                                        $rel_row   = $rel_select->fetch();
                                        $pay       = $rel_row['payment'];
                                    }
                                    else{
                                        $pay       = 0;
                                    }
                                    $bal       = $row_sel['amount'] - $pay;

                                    echo'<tr>';
                                        echo'<td>'.$g_row['fee'].'</td>'; 
                                        if($bal==0){
                                            echo'<td colspan="2">';
                                                echo'Paid';
                                            echo'</td>';
                                        }
                                        else{
                                                echo'<td>';
                                                    echo'<b>Monthly Payment Php '.number_format($fee, 2, '.', ',').'</b><br>';
                                                    echo'Balance : '.number_format($bal, 2, '.', ',').'';
                                                    echo'<input type="hidden" value="'.$bal.'" name="bal'.$g_row['fee_id'].'">';
                                                echo'</td>';
                                        }
                                        echo'</tr>';
                                }
                               // require_once'../../resources/script_orno.php';
                            ?>
                            </tbody>
                            
                        </table>
                        </div>
                        <div class="col-8" style=" display:inline-block; float:right;">
                        <table class="table table-bordered table-striped"  >
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;" colspan="3">
                                        Tranasction
                                        <a href="#payment" data-toggle="modal" style="float:right;" class="btn btn-success"><i class="fas fa-plus"></i> Add Payment</a>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="font-size: 12px;"></th>
                                    <th style="font-size: 12px;">Fee</th>
                                    <th style="font-size: 12px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total = 0;
                                    $tg_sel = "SELECT * FROM tbl_studentpaycon WHERE sy_id=:sy_id AND stud_id=:stud_id AND or_no=''";
                                    $tg_sele= $db->prepare($tg_sel);
                                    $tg_sele->bindParam(':sy_id',$_GET['sy_id']);
                                    $tg_sele->bindParam(':stud_id',$_GET['stud_id']);
                                    $tg_sele->execute();
                                    while($tg_row=$tg_sele->fetch()){

                                        $fg_sel = "SELECT * FROM tbl_fee WHERE fee_id=:fee_id";
                                        $fg_sele= $db->prepare($fg_sel);
                                        $fg_sele->bindParam(':fee_id',$tg_row['fee_id']);
                                        $fg_sele->execute();
                                        $fg_row = $fg_sele->fetch();

                                        echo'<tr>';
                                                echo'<td style="width:50px;"><a href="../../resources/delete.php?confirm=17&paycon_id='.$tg_row['paycon_id'].'&sy_id='.$tg_row['sy_id'].'&stud_id='.$tg_row['stud_id'].'" class="btn btn-danger"><i class="fas fa-trash"></i> </a></td>';
                                                echo'<td>'.$fg_row['fee'].'</td>';
                                                echo'<td>Php '.number_format($tg_row['amount'], 2, '.', ',').'</td>';
                                        echo'</tr>';

                                        $total = $total + $tg_row['amount'];
                                    }
                                
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><label style="float:right;">Total Payment :</label></td>
                                    <td><label><?php echo'Php '.number_format($total, 2, '.', ',')?></label></td>
                                </tr>
                                <?php
                                    if($total==0){
                                ?>
                                <tr>
                                    <td  colspan="2"><label style="float:right;">O.R. Number :</label></td>
                                    <td><input type="text" class="form-control" style="width:50%;" readonly autocomplete="off" name="ornumber" placeholder="Input O.R. Number"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label style="float:right;">Payee Name :</label></td>
                                    <td><input type="text" class="form-control" style="width:50%;" readonly autocomplete="off" name="name" placeholder="Input Payee Name" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" ></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label style="float:right;">Cash :</label></td>
                                    <td><input type="text" class="form-control" style="width:50%;" readonly onkeypress="return (event.charCode > 46 && event.charCode <= 57) || (event.charCode==46)" autocomplete="off" name="cash"  placeholder="Input Cash" ></td>
                                </tr>
                                <?php
                                    }
                                    else{
                                    
                                ?>
                                <tr>
                                    <td colspan="2"><label style="float:right;">O.R. Number :</label></td>
                                    <td><input type="text" class="form-control" style="width:50%;" autocomplete="off" name="ornumber" placeholder="Input O.R. Number"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label style="float:right;">Payee Name :</label></td>
                                    <td><input type="text" class="form-control" value="<?php echo $s_row['firstname'].' '.$s_row['lastname']?>" style="width:50%;" autocomplete="off" name="name" placeholder="Input Payee Name" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" ></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label style="float:right;">Cash :</label></td>
                                    <td><input type="text" class="form-control" style="width:50%;" onkeypress="return (event.charCode > 46 && event.charCode <= 57) || (event.charCode==46)" autocomplete="off" name="cash"  placeholder="Input Cash" ></td>
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <td colspan="2"></td>
                                    <td >
                                        <input type="hidden" name="bal" value="<?php echo $total?>" />
                                        <input type="hidden" name="sy_id" value="<?php echo $_GET['sy_id']?>" />
                                        <input type="hidden" name="stud_id" value="<?php echo $_GET['stud_id']?>" />
                                        <!-- <button type="submit" name="btn_update" class="btn btn-success"><i class="fas fa-edit"></i> Update Payment</button> 
                                        <button type="submit" name="btn_refresh" class="btn btn-danger"><i class="fas fa-refresh"></i> Reset Payment</button>  -->
                                        <?php
                                            if($total==0){
                                                echo'<button type="submit" disabled class="btn btn-info"><i class="fas fa-check"></i> Submit Payment</button>';
                                            }
                                            else{
                                                $rl_sel = "SELECT * FROM tbl_studentpay WHERE sy_id=:sy_id AND stud_id=:stud_id";
                                                $rl_sele= $db->prepare($rl_sel);
                                                $rl_sele->bindParam(':sy_id',$_GET['sy_id']);
                                                $rl_sele->bindParam(':stud_id',$_GET['stud_id']);
                                                $rl_sele->execute();
                                                if($rl_sele->rowCount()>=1){
                                                    echo'<button type="submit" name="btn_submit" class="btn btn-info"><i class="fas fa-check"></i> Submit Payment</button>';
                                                }
                                                else{
                                                    if($total>=2000){
                                                        echo'<button type="submit" name="btn_submit" class="btn btn-info"><i class="fas fa-check"></i> Submit Payment</button>';
                                                    }
                                                    else{
                                                        echo'Note : <b>on the first payment Php 2,000 is the initial payment.</b><br>';
                                                        echo'<button type="submit" disabled class="btn btn-info"><i class="fas fa-check"></i> Submit Payment</button>';
                                                    }
                                                }
                                                
                                            }
                                        ?>
                                         
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        </form>
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
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form role="form" method="post" action="../../resources/script_payment.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:18px;"><i class="fas fa-list"></i> Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Fee :</label>
                        <select name="fee_id" required class="form-control">
                            <option value="">Select Fee</option>
                            <?php
                                $b_sel = "SELECT * FROM tbl_studentpayment WHERE sy_id=:sy_id AND stud_id=:stud_id";
                                $b_sele= $db->prepare($b_sel);
                                $b_sele->bindParam(':sy_id',$_GET['sy_id']);
                                $b_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $b_sele->execute();
                                while($b_row=$b_sele->fetch()){

                                    $f_sel = "SELECT * FROM tbl_fee WHERE fee_id=:fee_id";
                                    $f_sele= $db->prepare($f_sel);
                                    $f_sele->bindParam(':fee_id',$b_row['fee_id']);
                                    $f_sele->execute();
                                    $f_row = $f_sele->fetch();
                                    
                                    echo'<option value="'.$f_row['fee_id'].'">'.$f_row['fee'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Amount Pay :</label>
                        <input type="text" onkeypress="return (event.charCode > 46 && event.charCode <= 57) || (event.charCode==46)" class="form-control" autocomplete="off" name="amount" placeholder="Input Amount to Pay" required="required" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="hidden" name="sy_id" value="<?php echo $_GET['sy_id']?>" />
                    <input type="hidden" name="stud_id" value="<?php echo $_GET['stud_id']?>" />
                    <button type="submit" name="btn_add" class="btn btn-info"><i class="fas fa-check"></i> Add</button> 
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>