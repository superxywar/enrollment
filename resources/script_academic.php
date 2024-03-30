<?php
    if(isset($_POST['btn_save'])){

        $sy_id    = $_POST['sy_id'];
        $name     = strtoupper($_POST['name']);
        $status   = 'Inactive';
        $stat_prep='';
        $e_sel = "SELECT * FROM tbl_academic WHERE sy_id=:sy_id AND program_name=:program_name";
        $e_sele= $db->prepare($e_sel);
        $e_sele->bindParam(':sy_id',$sy_id);
        $e_sele->bindParam(':program_name',$name);
        $e_sele->execute();

        if($e_sele->rowCount()==1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Academic program already exist
	              	</div>
              	</div>
            </div>';
        }
        else{
            // Insert image file name into database 
            $insert = "INSERT INTO tbl_academic(sy_id,program_name,status,stat_prep)VALUES(:sy_id,:program_name,:status,:stat_prep)";
            $inserts= $db->prepare($insert);
            $inserts->bindParam(':sy_id',$sy_id);
            $inserts->bindParam(':program_name',$name);
            $inserts->bindParam(':status',$status);
            $inserts->bindParam(':stat_prep',$stat_prep);
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