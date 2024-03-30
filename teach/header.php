<?php
    $p_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $p_sele= $db->prepare($p_sel);
    $p_sele->bindParam(':sy_id',$_SESSION['sy_id']);
    $p_sele->execute();
    $p_row = $p_sele->fetch();
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        
    </ul>
    <div class="col-11" >
        <p style="float:right; text-align:right; width:100%;">
            IPIL DISTRICT ADVENTIST ELEMENTARY SCHOOL INC. ONLINE ENROLLMENT SYSTEM<br>
            <b>S.Y. : <?php echo $p_row['start_year'].' - '.$p_row['end_year']?></b><br>
        </p>
    </div>
    
</nav>
<!-- /.navbar -->