<?php
    
    require_once'../../resources/message.php';

    $en_query = "SELECT * FROM tbl_enroll WHERE enroll_id=:enroll_id";
    $en_querys= $db->prepare($en_query);
    $en_querys->bindParam(':enroll_id',$_GET['enroll_id']);
    $en_querys->execute();
    $en_row   = $en_querys->fetch();

    $gn_query = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
    $gn_querys= $db->prepare($gn_query);
    $gn_querys->bindParam(':grade_id',$en_row['grade_id']);
    $gn_querys->execute();
    $gn_row   = $gn_querys->fetch();

    $sn_query = "SELECT * FROM tbl_section WHERE section_id=:section_id";
    $sn_querys= $db->prepare($sn_query);
    $sn_querys->bindParam(':section_id',$en_row['section_id']);
    $sn_querys->execute();
    $sn_row   = $sn_querys->fetch();

    $vn_query = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $vn_querys= $db->prepare($vn_query);
    $vn_querys->bindParam(':sy_id',$_SESSION['sy_id']);
    $vn_querys->execute();
    $vn_row   = $vn_querys->fetch();

    $tn_query = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
    $tn_querys= $db->prepare($tn_query);
    $tn_querys->bindParam(':stud_id',$en_row['stud_id']);
    $tn_querys->execute();
    $tn_row   = $tn_querys->fetch();

    // get the age
    $bday = new DateTime($tn_row['birth_date']); // Your date of birth
    $today = new Datetime(date('Y-m-d'));
    $diff = $today->diff($bday);
    $age  = $diff->y;
    
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
                    <h4 style="text-align:center;">To the Parents</h4>
                    <p style="text-align:justify;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This report card shows the ability and the progress your child has made in the
                        different learning areas as well as his/her progress in the character development<br><br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The School welcomes you and desire to know more about your child's progress.
                    </p>
                    <table class="table " style="line-height:10.0px;">
                        <tbody>
                                <tr>
                                    <td style="text-align:center;">______________</td>
                                    <td style="text-align:center;">______________</td>
                                </tr> 
                                <tr>
                                    <td style="text-align:center;">Teacher</td>
                                    <td style="text-align:center;">Principal</td>
                                </tr>
                        </tbody>         
                    </table>
                    <hr>
                    <h4 style="text-align:center;">Certificate of Transfer</h4>
                    <p style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admitted to Grade: &nbsp;&nbsp;<b><u><?php echo $gn_row['grade']?></u></b>  Section : &nbsp;&nbsp;<b><u><?php echo $sn_row['section']?></u></b><br><br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eligible for admission to Grade ______________.
                    </p>
                    <table class="table " style="line-height:10.0px;">
                        <tbody>
                                <tr>
                                    <td style="text-align:center;"> </td>
                                    <td style="text-align:center;">______________</td>
                                </tr> 
                                <tr>
                                    <td style="text-align:center;"></td>
                                    <td style="text-align:center;">Teacher</td>
                                </tr>
                        </tbody>         
                    </table>
                    <hr>
                    <h4 style="text-align:center;">Cancellation of Transfer Eligibility</h4>
                    <p style="text-align:jestify;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Has been admitted to: ____________________________________<br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Elementary School.<br><br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date: ___________________________
                    </p>
                    <table class="table " style="line-height:10.0px;">
                        <tbody>
                                <tr>
                                    <td style="text-align:center;"> </td>
                                    <td style="text-align:center;">______________</td>
                                </tr> 
                                <tr>
                                    <td style="text-align:center;"></td>
                                    <td style="text-align:center;">Teacher</td>
                                </tr>
                        </tbody>         
                    </table>
                </div>
                
            </div>
            <div class="col-6" >
                <h5 style="text-align:center;">Republic of the Philippines</h5>
                <h3 style="text-align:center; font-weight:bold;">DEPARTMENT OF EDUCATION</h3>
                <h5 style="text-align:center;">Region IX</h5>
                <h3 style="text-align:center; font-weight:bold;">ZAMBOANGA PENINSULA MISSION</h3>
                <h3 style="text-align:center; font-weight:bold;">SEVENTH-DAY ADVENTIST ELEMENTARY SCHOOL</h3>
                <br>
                <h4 style="text-align:center; font-weight:bold;">IPIL DISTRICT ADVENTIST ELEMENTARY SCHOOL INC.</h4>
                <p style="text-align:center;">
                    <img src="../admin/logo/SDA.jpg" style="text-align:center; width:250px; margin:auto;"><br>
                    <h4 style="text-align:center; font-weight:bold;">
                        "The School that Builds Children's Character for Eternity"
                    </h4><br>

                    <h4 style="text-align:center; font-weight:bold;">LEARNER'S PROGRESS REPORT CARD</h4>
                    <h4 style="text-align:center; font-weight:bold;"><?php echo $gn_row['grade'].' - '.$sn_row['section']?></h4>
                    <h5 style="text-align:center; ">SCHOOL YEAR <?php echo $vn_row['start_year'].' - '.$vn_row['end_year']?></h5><br>
                   
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name : <b><u><?php echo $tn_row['firstname'].' '.$tn_row['lastname']?></u></b><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Age : <b><u><?php echo $age?></u></b> Sex :<b><u><?php echo $tn_row['gender']?></u></b> LRN : <b><u><?php echo $tn_row['lrn_number']?></u></b> <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date of Birth : <b><u><?php echo date('F j, Y',strtotime($tn_row['birth_date']))?></u></b><br>
                </p>
                
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
