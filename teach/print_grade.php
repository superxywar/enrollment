<?php
    
    require_once'../../resources/message.php';

    
    
?>
<script language="Javascript" type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
        window.location.href = "index.php?page=app_printgrades"
    };
</script>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2"></div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6" >
                
                <div class="col-12">
                    <h4 style="text-align:center;">Report on Learning Progress and Achievement</h4>
                    <table class="table table-bordered " style="line-height:10.0px;">
                        <thead>
                            <tr>
                                <th rowspan="2">Learning Area</th>
                                <th colspan="4" style="text-align:center;">Quarterly</th>
                                <th rowspan="2">Final Rating</th>
                                <th rowspan="2">Remarks</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $rating      = 0;
                                $general     = 0;
                                $general_avg = 0;
                                
                                $e_sel = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id ORDER BY ensub_id ASC";
                                $e_sele= $db->prepare($e_sel);
                                $e_sele->bindParam(':enroll_id',$_GET['enroll_id']); 
                                $e_sele->execute();
                                $count = $e_sele->rowCount();
                                while($e_row=$e_sele->fetch()){

                                    $s_sel = "SELECT subject FROM tbl_subject WHERE sub_id=:sub_id ";
                                    $s_sele= $db->prepare($s_sel);
                                    $s_sele->bindParam(':sub_id',$e_row['sub_id']);
                                    $s_sele->execute();
                                    $s_row = $s_sele->fetch();
                                    
                                    $g_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                    $g_sele= $db->prepare($g_sel);
                                    $g_sele->bindParam(':ensub_id',$e_row['ensub_id']);
                                    $g_sele->execute();
                                    $g_row = $g_sele->fetch();

                                    $rating = ($g_row['first_quarter']+$g_row['second_quarter']+$g_row['third_quarter']+$g_row['fourth_quarter']) / 4;

                                    if($rating>=75){
                                        $remarks = 'Passed';
                                    }
                                    else{
                                        $remarks = 'Failed';
                                    }
                                    echo'<tr>';
                                        echo'<td>'.$s_row['subject'].'</td>';
                                        echo'<td>'.$g_row['first_quarter'].'</td>';
                                        echo'<td>'.$g_row['second_quarter'].'</td>';
                                        echo'<td>'.$g_row['third_quarter'].'</td>';
                                        echo'<td>'.$g_row['fourth_quarter'].'</td>';
                                        echo'<td>'.round($rating, 2).'</td>';
                                        echo'<td>'.$remarks.'</td>';
                                    echo'</tr>';

                                    $general = $general + $rating;
                                } 
                                $general_avg = $general / $count;
                                if($general_avg>=75){
                                    $remark = 'Passed';
                                }
                                else{
                                    $remark = 'Failed';
                                }
                                echo'<tr>';
                                    echo'<td colspan="5" style="text-align:right;">General Average</td>';
                                    echo'<td>'.round($general_avg, 2).'</td>';
                                    echo'<td>'.$remark.'</td>';
                                echo'</tr>';

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12"> 
                    <table class="table table-bordered " style="line-height:10.0px;">
                        <thead>
                            <tr>
                                <th >Descriptors</th>
                                <th >Grading Scale</th>
                                <th >Remarks</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <tr>
                                <td>Outstanding</td>
                                <td>90-100</td>
                                <td>Passed</td>
                            </tr>
                            <tr>
                                <td>Very Satisfactory</td>
                                <td>85-89</td>
                                <td>Passed</td>
                            </tr>
                            <tr>
                                <td>Satisfactory</td>
                                <td>80-84</td>
                                <td>Passed</td>
                            </tr>
                            <tr>
                                <td>Fairly Satisfactory</td>
                                <td>75-79</td>
                                <td>Passed</td>
                            </tr>
                            <tr>
                                <td>Did Not Meet Expectations</td>
                                <td>75-79</td>
                                <td>Failed</td>
                            </tr>
                        </tbody>         
                    </table>
                </div>
            </div>
            <div class="col-6" >
                <h4 style="text-align:center;">Report on Learning Progress and Achievement</h4>
                <table class="table table-bordered " style="line-height:10.0px;">
                    <thead>
                        <tr>
                            <th rowspan="2">Core Values</th>
                            <th rowspan="2">Behavior Statements</th>
                            <th colspan="4" style="text-align:center;">Quarter</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="2">1. Maka Diyos</td>
                            <td>Expresses one's spiritual beliefs<br><br>
                            while respecting the spiritual beliefs of others

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Shows adherence to ethical principles by upholding truth.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td rowspan="2">2. Makatao</td>
                            <td>Is sensitive to individual, social and<br><br>
                            cultural difference
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Demonstrates contributions toward solidarity.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3. Maka-Kalikasan</td>
                            <td>Cares for the environment and utilizes resources wisely<br><br>
                            judiciously and economically.
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td rowspan="2">4. Maka-Bansa</td>
                            <td>Demonstrates pride in being a Filipino<br><br>
                            Exercises the rights and responsibilities of a filipino citizen.
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Demonstrates appropriate behavior in carrying out activities in the school,<br><br> community and country.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered " style="line-height:10.0px;">
                        <thead>
                            <tr>
                                <th colspan="2">Marking</th>
                                <th >Non-Numeric Rating</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <tr>
                                <td>AO</td>
                                <td>95-100</td>
                                <td>Always Observed</td>
                            </tr>
                            <tr>
                                <td>SO</td>
                                <td>88-94</td>
                                <td>Sometimes Observed</td>
                            </tr>
                            <tr>
                                <td>RO</td>
                                <td>81-87</td>
                                <td>Rarely Observed</td>
                            </tr>
                            <tr>
                                <td>NO</td>
                                <td>75-80</td>
                                <td>Not Observed</td>
                            </tr>   
                        </tbody>         
                </table>
                <h4 style="text-align:center;">Parent/ Guardian Signature</h4>
                <table class="table " style="line-height:10.0px;">
                    <tbody>
                            <tr>
                                <td>1st Quarter</td>
                                <td>______________</td>
                                <td>3rd Quarter</td>
                                <td>______________</td>
                            </tr>  
                            <tr>
                                <td>2nd Quarter</td>
                                <td>______________</td>
                                <td>4th Quarter</td>
                                <td>______________</td>
                            </tr> 
                    </tbody>         
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
