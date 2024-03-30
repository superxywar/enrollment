<?php
    $a_sel = "SELECT * FROM tbl_academic WHERE status='Active'";
    $a_sele= $db->prepare($a_sel);
    $a_sele->execute();
    if($a_sele->rowCount()==1){
        $a_row = $a_sele->fetch(); 
        $acad_id    = $a_row['acad_id'];
        $acad_name  = $a_row['program_name'];
    }
    else{
        $acad_id = 0;
        $acad_name = 'No Active Academic Program';
    }

    
    $l_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
    $l_sele= $db->prepare($l_sel);
    $l_sele->bindParam(':grade_id',$_GET['grade_id']);
    $l_sele->execute();
    $l_row = $l_sele->fetch();

    $ss_sel = "SELECT * FROM tbl_section WHERE section_id=:section_id";
    $ss_sele= $db->prepare($ss_sel);
    $ss_sele->bindParam(':section_id',$_GET['section_id']);
    $ss_sele->execute();
    $ss_row = $ss_sele->fetch();
    
    $t_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $t_sele= $db->prepare($t_sel);
    $t_sele->bindParam(':sy_id',$_SESSION['sy_id']);
    $t_sele->execute();
    $t_row = $t_sele->fetch();

    require_once'../../resources/script_schedule.php';
    require_once'../../resources/message.php';
    
    
?>
<style type="text/css">
    #bordered {
        border-color:red;
    }
</style>
<!-- <script>
    function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp=false;  
        try{
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)    {       
            try{            
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1){
                    xmlhttp=false;
                }
            }
        }
            
        return xmlhttp;
    }
    function getState(countryId) {      
        
        var strURL="select_subject.php?country="+countryId;
        var req = getXMLHTTP();
        
        if (req) {
            
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {                        
                        document.getElementById('statediv').innerHTML=req.responseText;                     
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }               
            }           
            req.open("GET", strURL, true);
            req.send(null);
        }  
    }
</script> -->
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-calendar"></i>&nbsp;&nbsp;Schedule</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Academic Program :</label>
                                    <input type="hidden" class="form-control" name="acad_id" value="<?php echo $acad_id?>">
                                    <input type="hidden" class="form-control" name="sy_id" value="<?php echo $_SESSION['sy_id']?>">
                                    <input type="text" class="form-control"  autocomplete="off" placeholder="<?php echo $acad_name?>" readonly >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Grade Level :</label>
                                    <input type="hidden" class="form-control" name="grade_id" value="<?php echo $_GET['grade_id']?>">
                                    <input type="text" class="form-control"  autocomplete="off" placeholder="<?php echo $l_row['grade']?>" readonly >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Section :</label>
                                    <input type="hidden" class="form-control" name="section_id" value="<?php echo $_GET['section_id']?>">
                                    <input type="text" class="form-control"  autocomplete="off" placeholder="<?php echo $ss_row['section']?>" readonly >
                                </div>
                            </div>
                            
                            <?php
                                if($i>=1){

                                    $bb_sel = "SELECT sub_id,subject FROM tbl_subject WHERE sub_id=:sub_id";
                                    $bb_sele= $db->prepare($bb_sel);
                                    $bb_sele->bindParam(':sub_id',$subs_id);
                                    $bb_sele->execute();
                                    $bb_row = $bb_sele->fetch();

                                    $rr_sel = "SELECT room_id,room FROM tbl_room WHERE room_id=:room_id";
                                    $rr_sele= $db->prepare($rr_sel);
                                    $rr_sele->bindParam(':room_id',$_POST['room_id']);
                                    $rr_sele->execute();
                                    $rr_row = $rr_sele->fetch();
                            ?>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject</label>
                                    <select  name="sub_id" class="form-control select2" required>
	                                    <option value="<?php echo $bb_row['sub_id']?>"><?php echo $bb_row['subject'];?></option>
                                        <?php
                                            $query	=	"SELECT * FROM tbl_acadcon WHERE acad_id=:acad_id AND grade_id=:grade_id  AND NOT EXISTS (SELECT * FROM tbl_schedule WHERE sy_id=:sy_id AND tbl_acadcon.sub_id=tbl_schedule.sub_id AND tbl_acadcon.grade_id=tbl_schedule.grade_id) ";
                                            $queries= $db->prepare($query);
                                            $queries->bindParam(':acad_id',$acad_id);
                                            $queries->bindParam(':grade_id',$_GET['grade_id']);
                                            $queries->bindParam(':sy_id',$_SESSION['sy_id']);
                                            $queries->execute();
                                            while($row=$queries->fetch()){
                                                $gg_sel = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                                $gg_sele= $db->prepare($gg_sel);
                                                $gg_sele->bindParam(':sub_id',$row['sub_id']);
                                                $gg_sele->execute();
                                                $gg_row = $gg_sele->fetch();

                                                echo'<option value="'.$row['sub_id'].'">'.$gg_row['subject'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Room :</label>
                                    <select name="room_id" class="form-control select2" required>
                                        <option value="<?php echo $rr_row['room_id']?>"><?php echo $rr_row['room']?></option>
                                        <?php
                                            $rg_sel = "SELECT * FROM tbl_room ORDER BY room ASC";
                                            $rg_sele= $db->prepare($rg_sel);
                                            $rg_sele->execute();
                                            while($rg_row=$rg_sele->fetch()){
                                                echo'<option value="'.$rg_row['room_id'].'">'.$rg_row['room'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Class Size</label>
                                    <input type="number" class="form-control"  value="<?php echo $_POST['size']?>" autocomplete="off" name="size" placeholder="Enter Class Size" required="required" >
                                </div>
                            </div>    
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Day</label>
                                    <input type="text" class="form-control" id="bordered" autocomplete="off" name="day" value="<?php echo $_POST['day']?>" placeholder="Enter Day" required="required" >
                                </div>
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Time Start</label>
                                    <input type="time" class="form-control" id="bordered" autocomplete="off" name="time_start" value="<?php echo $_POST['time_start']?>" placeholder="Enter Day" required="required" >
                                </div>
                            </div>
                            
                            <?php
                                }
                                else{
                            ?>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject</label>
                                    <select  name="sub_id" class="form-control select2" required>
	                                    <option value="">Select Subject</option>
                                        <?php
                                            $query	=	"SELECT * FROM tbl_acadcon WHERE acad_id=:acad_id AND grade_id=:grade_id  AND NOT EXISTS (SELECT * FROM tbl_schedule WHERE sy_id=:sy_id AND tbl_acadcon.sub_id=tbl_schedule.sub_id AND tbl_acadcon.grade_id=tbl_schedule.grade_id) ";
                                            $queries= $db->prepare($query);
                                            $queries->bindParam(':acad_id',$acad_id);
                                            $queries->bindParam(':grade_id',$_GET['grade_id']);
                                            $queries->bindParam(':sy_id',$_SESSION['sy_id']);
                                            $queries->execute();
                                            while($row=$queries->fetch()){
                                                $gg_sel = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                                $gg_sele= $db->prepare($gg_sel);
                                                $gg_sele->bindParam(':sub_id',$row['sub_id']);
                                                $gg_sele->execute();
                                                $gg_row = $gg_sele->fetch();

                                                echo'<option value="'.$row['sub_id'].'">'.$gg_row['subject'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Room :</label>
                                    <select name="room_id" class="form-control select2" required>
                                        <option value="">Select Room</option>
                                        <?php
                                            $rg_sel = "SELECT * FROM tbl_room ORDER BY room ASC";
                                            $rg_sele= $db->prepare($rg_sel);
                                            $rg_sele->execute();
                                            while($rg_row=$rg_sele->fetch()){
                                                echo'<option value="'.$rg_row['room_id'].'">'.$rg_row['room'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Class Size</label>
                                    <input type="number" class="form-control" autocomplete="off" name="size" placeholder="Enter Class Size" required="required" >
                                </div>
                            </div>    
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Day</label>
                                    <input type="text" class="form-control"  autocomplete="off" name="day" placeholder="Enter Day" required="required" >
                                </div>
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Time Start</label>
                                    <input type="time" class="form-control" autocomplete="off" name="time_start" placeholder="Enter Day" required="required" >
                                </div>
                            </div>
                            
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <?php
                            if($acad_id==0){
                                echo'<button type="submit" disabled class="btn btn-primary" name="btn_save" style="float:right;"><i class="nav-icon fas fa-check"></i>&nbsp;Submit</button>';
                            }
                            else{
                                echo'<button type="submit" class="btn btn-primary" name="btn_save" style="float:right;"><i class="nav-icon fas fa-check"></i>&nbsp;Submit</button>';
                            }
                        ?>
                    </div>
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
                        <h3 class="card-title"><i class="nav-icon fas fa-calendar"></i>&nbsp;List of Schedule School Year : <?php echo $t_row['start_year'].' - '.$t_row['end_year']?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    <th>Room</th>
                                    <th>Learning Areas</th>
                                    <th>Class Size</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $u_sel = "SELECT * FROM tbl_schedule WHERE sy_id=:sy_id ORDER BY sched_id DESC";
                                    $u_sele= $db->prepare($u_sel);
                                    $u_sele->bindParam(':sy_id',$_SESSION['sy_id']);
                                    $u_sele->execute();
                                    while($u_row=$u_sele->fetch()){
                                        
                                        $gr_sel = "SELECT grade FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                        $gr_sele= $db->prepare($gr_sel);
                                        $gr_sele->bindParam(':grade_id',$u_row['grade_id']);
                                        $gr_sele->execute();
                                        $gr_row = $gr_sele->fetch();

                                        $ts_sel = "SELECT subject FROM tbl_subject WHERE sub_id=:sub_id";
                                        $ts_sele= $db->prepare($ts_sel);
                                        $ts_sele->bindParam(':sub_id',$u_row['sub_id']);
                                        $ts_sele->execute();
                                        $ts_row = $ts_sele->fetch();

                                        $rt_sel = "SELECT room FROM tbl_room WHERE room_id=:room_id";
                                        $rt_sele= $db->prepare($rt_sel);
                                        $rt_sele->bindParam(':room_id',$u_row['room_id']);
                                        $rt_sele->execute();
                                        $rt_row = $rt_sele->fetch();

                                        $rs_sel = "SELECT section FROM tbl_section WHERE section_id=:section_id";
                                        $rs_sele= $db->prepare($rs_sel);
                                        $rs_sele->bindParam(':section_id',$u_row['section_id']);
                                        $rs_sele->execute();
                                        $rs_row = $rs_sele->fetch();


                                        echo'<tr>';
                                            echo'<td><label style="font-weight:normal;">'.$gr_row['grade'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$rs_row['section'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$rt_row['room'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$ts_row['subject'].'</label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$u_row['class_size'].'</label></td>';
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.$u_row['day'].'</label></td>';
                                            
                                            echo'<td><label style="font-weight:normal; text-transform:uppercase;">'.date('h:i A',strtotime($u_row['time_start'])).' - '.date('h:i A',strtotime($u_row['time_end'])).'</label></td>';
                                            echo'<td>';
                                                $n_sel = "SELECT * FROM tbl_load WHERE sched_id=:sched_id";
                                                $n_sele= $db->prepare($n_sel);
                                                $n_sele->bindParam(':sched_id',$u_row['sched_id']);
                                                $n_sele->execute();
                                                if($n_sele->rowCount()>=1){
                                               
                                                    echo'<a href="" data-toggle="modal" class="btn btn-default"><i class="nav-icon fas fa-trash"></i>&nbsp;Remove Schedule </a>';
                                                       
                                                }
                                                else{
                                                    echo'<a href="#remove'.$u_row['sched_id'].'" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Remove Schedule </a>';
                                                
                                                }
                                               
                                            echo'</td>';
                                        echo'</tr>';
                                    }
                                ?>
                            </tbody>
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
    $jselect  = "SELECT * FROM tbl_schedule ORDER BY sched_id DESC";
    $jquery   =   $db->prepare($jselect);
    $jquery->execute();
    while($jrow=$jquery->fetch()){
    
?>

<div class="modal fade" id="remove<?php echo $jrow['sched_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message Prompt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label>Are you sure you want to remove this schedule?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?sched_id=<?php echo $jrow['sched_id']?>&confirm=9&grade_id=<?php echo $_GET['grade_id']?>&section_id=<?php echo $_GET['section_id']?>" class="btn btn-danger"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    }
?>