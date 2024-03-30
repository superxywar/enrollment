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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="col-12" style="margin:auto; text-align:left; text-transform:uppercase; font-weight:bold; padding-top:40px;">
                        <p style="padding-left:15px;">
                            MY CLASS SCHEDULE
                        </p>
                        <hr>
                    </div>
                    <div class="col-12" style="margin:auto;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">S. Y.</th>
                                    <th style="font-size: 12px;">Grade & Section</th>
                                    <th style="font-size: 12px;">Student Status</th>
                                    <th style="font-size: 12px;">Enrollment Status</th>
                                    <th style="font-size: 12px;">Option</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                                $sel_query ="SELECT * FROM tbl_enroll WHERE stud_id=:stud_id  AND section_id!=0 ORDER BY enroll_id DESC";
                                $select_query =$db->prepare($sel_query);
                                $select_query->bindParam(':stud_id',$_SESSION['stud_id']);
                                $select_query->execute();
                                while($row_sel =$select_query->fetch()){
                                    
                                    $j_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
                                    $j_sele= $db->prepare($j_sel);
                                    $j_sele->bindParam(':sy_id',$row_sel['sy_id']);
                                    $j_sele->execute();
                                    $j_row = $j_sele->fetch();

                                    $s_sel = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
                                    $s_sele= $db->prepare($s_sel);
                                    $s_sele->bindParam(':stud_id',$row_sel['stud_id']);
                                    $s_sele->execute();
                                    $s_row = $s_sele->fetch();

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
                                        echo'<td>'.$j_row['start_year'].' - '.$j_row['end_year'].'</td>'; 
                                        echo'<td> '.$g_row['grade'].' - '.$sections.'</td>'; 
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
                                            if($row_sel['stat_enroll']=='Enrolled'){
                                                echo'<a href="print.php?page=print_subjectlist&enroll_id='.$row_sel['enroll_id'].'" class="btn btn-info btn-sm"><i class="fa fa-search"></i> View Subject Load</a>&nbsp;';
                                                echo'<a href="index.php?page=print_subjectgrades&enroll_id='.$row_sel['enroll_id'].'" class="btn btn-info btn-sm"><i class="fa fa-search"></i> View Grades</a>&nbsp;';
                                            }
                                            
                                            
                                        echo'</td>'; 
                                    echo'</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>