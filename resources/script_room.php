<?php
    if(isset($_POST['btn_save'])){

        $room  = strtoupper($_POST['room']);

        $e_sel = "SELECT * FROM tbl_room WHERE room=:room";
        $e_sele= $db->prepare($e_sel);
        $e_sele->bindParam(':room',$room);
        $e_sele->execute();

        if($e_sele->rowCount()==1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Room already exist
	              	</div>
              	</div>
            </div>';
        }
        else{
            // Insert image file name into database 
            $insert = "INSERT INTO tbl_room(room)VALUES(:room)";
            $inserts= $db->prepare($insert);
            $inserts->bindParam(':room',$room);
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
?>