<?php
    $i = 0;
    if(isset($_POST['btn_save'])){
        $sy_id       = $_POST['sy_id'];
        $acad_id     = $_POST['acad_id'];
        $grade_id    = $_POST['grade_id'];
        $sub_id      = $_POST['sub_id'];
        $section_id  = $_POST['section_id'];
        $room_id     = $_POST['room_id'];
        $size        = $_POST['size'];



        //QUERY FOR ALLOTTED TIME
        $a_sel       = 'SELECT * FROM tbl_acadcon WHERE acad_id=:acad_id AND grade_id=:grade_id AND sub_id=:sub_id';
        $a_sele      = $db->prepare($a_sel);
        $a_sele      ->bindParam(':acad_id',$acad_id);
        $a_sele      ->bindParam(':grade_id',$grade_id);
        $a_sele      ->bindParam(':sub_id',$sub_id);
        $a_sele      ->execute();
        $a_row       = $a_sele->fetch();

        $day         = strtoupper($_POST['day']);
        $time_start  = date('h:i A',strtotime($_POST['time_start']));
        $time_ends   = date('h:i A',strtotime($time_start . ' +'.$a_row['min'].' minutes'));
        $time_end    = $time_ends;
        //$others      = $_POST['other'];
        $new_start_timestamp = strtotime($time_start);
        $new_end_timestamp = strtotime($time_end);
        
        $subs_id = $_POST['sub_id'];
        

        if($acad_id==0){
            echo'
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissible" style="margin:10px;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
                            There was no active academic program.
                        </div>
                    </div>
            </div>';
        }
        else{
            $e_sel = "SELECT * FROM tbl_schedule WHERE sy_id=:sy_id AND acad_id=:acad_id AND grade_id=:grade_id AND sub_id=:sub_id AND section_id=:section_id AND room_id=:room_id AND class_size=:class_size AND day=:day AND time_start=:time_start AND time_end=:time_end";
            $e_sele= $db->prepare($e_sel);
            $e_sele->bindParam(':sy_id',$sy_id);
            $e_sele->bindParam(':acad_id',$acad_id);
            $e_sele->bindParam(':grade_id',$grade_id);
            $e_sele->bindParam(':sub_id',$subs_id);
            $e_sele->bindParam(':section_id',$section_id);
            $e_sele->bindParam(':room_id',$room_id);
            $e_sele->bindParam(':class_size',$size);
            $e_sele->bindParam(':day',$day);
            $e_sele->bindParam(':time_start',$time_start);
            $e_sele->bindParam(':time_end',$time_end);
            $e_sele->execute();

            if($e_sele->rowCount()==1){
                echo'
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissible" style="margin:10px;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
                            Schedule already exist.
                        </div>
                    </div>
                </div>';
            }
            else{

                $sel 	= "SELECT * FROM tbl_schedule WHERE sy_id=:sy_id AND room_id=:room_id AND day=:day";
        		$sele   = $db->prepare($sel);
        		$sele	->bindParam(':sy_id',$_SESSION['sy_id']);
        		$sele   ->bindParam(':room_id',$room_id);
        		$sele   ->bindParam(':day',$day);
        		$sele   ->execute();
        
        		if($sele->rowCount()>=1){
        			while($s_row = $sele->fetch()){
                    
                        $existing_start_timestamp = strtotime($s_row['time_start']);
                        $existing_end_timestamp   = strtotime($s_row['time_end']);
                        
                        if(($new_start_timestamp >= $existing_start_timestamp && $new_start_timestamp < $existing_end_timestamp) ||
                        ($new_end_timestamp > $existing_start_timestamp && $new_end_timestamp <= $existing_end_timestamp) ||
                        ($new_start_timestamp <= $existing_start_timestamp && $new_end_timestamp >= $existing_end_timestamp)){
                            $i++;
                        }
                    }
                }


                if($i>=1){
                    echo'<div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible"  style="margin:10px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Alert!!! </h4>
                                    Schedule has a conflict with other schedule
                                </div>
                            </div>
                    </div>';
                }
                else{
                    $teach_id = 0;
                    // Insert image file name into database 
                    $insert = "INSERT INTO tbl_schedule(sy_id,acad_id,grade_id,sub_id,section_id,room_id,teach_id,class_size,day,time_start,time_end)VALUES(:sy_id,:acad_id,:grade_id,:sub_id,:section_id,:room_id,:teach_id,:class_size,:day,:time_start,:time_end)";
                    $inserts= $db->prepare($insert);
                    $inserts->bindParam(':sy_id',$sy_id);
                    $inserts->bindParam(':acad_id',$acad_id);
                    $inserts->bindParam(':grade_id',$grade_id);
                    $inserts->bindParam(':sub_id',$subs_id);
                    $inserts->bindParam(':section_id',$section_id);
                    $inserts->bindParam(':room_id',$room_id);
                    $inserts->bindParam(':teach_id',$teach_id);
                    $inserts->bindParam(':class_size',$size);
                    $inserts->bindParam(':day',$day);
                    $inserts->bindParam(':time_start',$time_start);
                    $inserts->bindParam(':time_end',$time_end);
                    $inserts->execute();
                    
                    echo'<div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                                    Data successfully save.
                                </div>
                            </div>
                    </div>';
                }     
            }
        }
    }
?>