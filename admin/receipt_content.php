
<?php
    
    $o_sel = "SELECT * FROM tbl_studentpay WHERE or_no=:or_no";
    $o_sele= $db->prepare($o_sel);
    $o_sele->bindParam(':or_no',$_GET['orno']);
    $o_sele->execute();
    $o_row = $o_sele->fetch();
?>
<script type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
        window.location.href = "index.php?page=app_listpayment&stud_id=<?php echo $_GET['stud_id']?>"
    };
    </script>
<div >
    <div class="row">
        <div class="col-lg-12">
            <p style="font-family: 'Trispace', sans-serif; text-align:center; line-height: 0.7em; padding-top:10px;">
                <b style="font-size:11px;">Ipil District Adventist Elementary School Inc.</b><br>
                <span style="font-size:8px;">Sanito, Ipil, Zamboanga Sibugay Philippines</span>
                <br><br><br><b>RECEIPT</b>
                
            </p>
        </div>
        <div class="col-lg-12" style="margin-top:5px; margin-left:10px; padding-right:10px;">
            <table style="width:100%; line-height: 0.8em; padding-bottom:10px;">
                <tr>
                    <td style="width:80px;"><label  style="font-family: 'Trispace', sans-serif; font-size:8px;">O.R. NO. :</label></td>
                    <td><label style="font-weight:normal; font-family: 'Trispace', sans-serif; font-size:8px;"><?php echo $o_row['or_no']?></label></td>
                </tr>
                <tr>
                    <td style="width:80px;"><label  style="font-family: 'Trispace', sans-serif; font-size:8px;">DATE & TIME :</label></td>
                    <td><label style="font-weight:normal; font-family: 'Trispace', sans-serif; font-size:8px; text-transform:uppercase;"><?php echo date('F d, Y', strtotime($o_row['date'])).' - '.date('h:i A', strtotime($o_row['time']))?></label></td>
                </tr>
                <tr>
                    <td style="width:80px;"><label  style="font-family: 'Trispace', sans-serif; font-size:8px;">PAYEE NAME:</label></td>
                    <td colspan="3"><label style="font-weight:normal; font-family: 'Trispace', sans-serif; font-size:8px; text-transform:uppercase;"><?php echo $o_row['payee_name']?></label></td>
                </tr>
            </table>
            <hr>
            <table id="tables" >
                    <thead style="font-weight:100;">
                        <tr >
                            <th style="font-family: 'Trispace', sans-serif; font-size:10px; border:none; text-align:left;">Particular</th>
                            <th style="font-family: 'Trispace', sans-serif; font-size:10px; border:none;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>            
                        <?php
                            $total  = 0;
                            $query  = "SELECT * FROM tbl_studentpaycon WHERE or_no=:or_no";
                            $queries= $db->prepare($query);
                            $queries->bindParam(':or_no',$_GET['orno']);
                            $queries->execute();
                            if($queries->rowCount()>=1){
                                while($row=$queries->fetch()){
                                        
                                    
                                    $g_sel = "SELECT * FROM tbl_fee WHERE fee_id=:fee_id";
                                    $g_sele= $db->prepare($g_sel);
                                    $g_sele->bindParam(':fee_id',$row['fee_id']);
                                    $g_sele->execute();
                                    $g_row = $g_sele->fetch();
                                     

                                    $total   = $total + $row['amount'];
                                    echo'<tr>';
                                        echo'<td style="font-size:8.8px; border:none; width:250px;">'.$g_row['fee'].'</td>';
                                        echo'<td style="font-size:7.8px; border:none;">'.number_format($row['amount'], 2, '.', ',').'</td>';
                                    echo'</tr>';
                                    
                                }
                            }
                            
                        ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="border:none; ">
                            <hr></hr>
                        </td>
                    </tr>
                    <tr>
                        <td style="border:none; ">
                            <label style="font-size:8px; float:right;">Amount Due :</label>
                        </td>
                        <td style="border:none; font-size:9px;"><b><?php echo number_format($_GET['bal'], 2, '.', ',')?></b></td>
                    </tr>
                    <?php
                        $change = 0;
                        if(isset($_GET['cash'])&&isset($_GET['bal'])){
                            $cash = $_GET['cash'];
                            $bal  = $_GET['bal'];

                            if($cash>=$bal){
                                $change = $cash - $bal;
                            
                    ?>
                    <tr>
                        <td style="border:none; ">
                            <label style="font-size:8px; float:right;">Cash :</label>
                        </td>
                        <td style="border:none; font-size:9px; "><b><?php echo number_format($_GET['cash'], 2, '.', ',')?></b></td>
                    </tr>
                    <tr>
                        <td style="border:none; ">
                            <label style="font-size:8px; float:right;">Change :</label>
                        </td>
                        <td style="border:none; font-size:9px; "><b><?php echo number_format($change, 2, '.', ',')?></b></td>
                    </tr>
                    <?php
                            }
                            else{
                            $balance = 0;

                            $balance = $bal - $cash;
                    ?>
                    <tr>
                        <td style="border:none; ">
                            <label style="font-size:8px; float:right;">Cash :</label>
                        </td>
                        <td style="border:none; font-size:9px; "><b><?php echo number_format($_GET['cash'], 2, '.', ',')?></b></td>
                    </tr>
                    <tr>
                        <td style="border:none; ">
                            <label style="font-size:8px; float:right;">Balance :</label>
                        </td>
                        <td style="border:none; font-size:9px; "><b><?php echo number_format($balance, 2, '.', ',')?></b></td>
                    </tr>
                    <?php           
                                
                            }    
                        }
                    
                    ?>
                </tfoot>
            </table>
        </div>
    </div>
</div>
