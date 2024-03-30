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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Daily Collection Report</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post"  enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date :</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="btn_search" style="float:right;"><i class="nav-icon fas fa-search"></i>&nbsp;Generate Report</button>
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
            <div class="col-md-12">
            <!-- general form elements -->
                <div class="card card-primary">
                    <div class="col-8" style="margin:auto; text-align:center; text-transform:uppercase; font-weight:bold; padding-top:40px;">
                        <p>
                            DAILY COLLECTION REPORT : <?php echo date('F j, Y', strtotime($_POST['date']))?>
                        </p>
                        <hr>
                    </div>
                    <div class="col-12" style="margin:auto;">
                        
                        <table class="table table-bordered " style="line-height:10.0px;">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>O.R. No.</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $total  = 0;
                                $su_sel = "SELECT * FROM tbl_studentpay WHERE date=:date";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':date',$_POST['date']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){

                                    $total = $total + $su_row['amount'];
                                    echo'<tr>';
                                        echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.date('F j, Y',strtotime($su_row['date'])).' - '.date('h:i A',strtotime($su_row['time'])).'</label></td>';
                                        echo'<td><label style="font-weight:normal;">'.$su_row['or_no'].'</label></td>';
                                        echo'<td><label style="font-weight:normal;">Php '.number_format($su_row['amount'], 2, '.', ',').'</label></td>';
                                    echo'</tr>';
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><label>Grand Total Collection : </label></td>
                                    <td><?php echo 'Php '.number_format($total, 2, '.', ',')?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                </div>
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