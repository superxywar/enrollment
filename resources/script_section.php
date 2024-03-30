<?php
    if(isset($_POST['btn_save'])){

        $grade_id = $_POST['grade_id'];
        $section  = strtoupper($_POST['section']);

        $e_sel = "SELECT * FROM tbl_section WHERE section=:section";
        $e_sele= $db->prepare($e_sel);
        $e_sele->bindParam(':section',$section);
        $e_sele->execute();

        if($e_sele->rowCount()==1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Section already exist
	              	</div>
              	</div>
            </div>';
        }
        else{
            // Insert image file name into database 
            $insert = "INSERT INTO tbl_section(grade_id,section)VALUES(:grade_id,:section)";
            $inserts= $db->prepare($insert);
            $inserts->bindParam(':grade_id',$grade_id);
            $inserts->bindParam(':section',$section);
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