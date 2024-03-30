<?php
    $i_sel = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stat_enroll='Enrolled' GROUP BY stud_id";
    $i_sele= $db->prepare($i_sel);
    $i_sele->bindParam(':sy_id',$_SESSION['sy_id']);
    $i_sele->execute();

    if($i_sele->rowCount()>=1){
        $i_count = $i_sele->rowCount();
    }
    
    else{
        $i_count =0 ;
    }


    $ii_sel = "SELECT * FROM tbl_teacher WHERE status='Active'";
    $ii_sele= $db->prepare($ii_sel);
    $ii_sele->execute();
    if($ii_sele->rowCount()>=1){
        $ii_count = $ii_sele->rowCount();
    }
    
    else{
        $ii_count =0 ;
    }
    
    $pii_sel = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stat_enroll='Pending Application'";
    $pii_sele= $db->prepare($pii_sel);
    $pii_sele->bindParam(':sy_id',$_SESSION['sy_id']);
    $pii_sele->execute();
    if($pii_sele->rowCount()>=1){
        $pii_count = $pii_sele->rowCount();
    }
    
    else{
        $pii_count =0 ;
    }
?>
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo $i_count;?></h3>
                    <p>Total No. of Enrolled Student</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $ii_count;?></h3>
                    <p>Total No. of Teacher</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <a href="index.php?page=app_listpenenrollment">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo $pii_count;?></h3>
                    <p>Total No. of Pending Application</p>
                </div>
                <div class="icon">
                    <i class="ion ion-folder"></i>
                </div>
            </div>
            </a>
        </div>
        
    </div>
</div>