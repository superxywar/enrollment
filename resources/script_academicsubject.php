<?php
    if(isset($_POST['btn_save'])){

        $grade_id    = $_POST['grade_id'];
        $sub_id      = $_POST['sub_id'];
        $acad_id     = $_GET['acad_id'];

        //$hour        = $_POST['hour'];
        $min         = $_POST['min'];
        $i=0;
        foreach ($_POST['sub_id'] as $sub_id){
            $e_sel = "SELECT * FROM tbl_acadcon WHERE acad_id=:acad_id AND grade_id=:grade_id AND sub_id=:sub_id AND min=:min";
            $e_sele= $db->prepare($e_sel);
            $e_sele->bindParam(':acad_id',$acad_id);
            $e_sele->bindParam(':grade_id',$grade_id);
            $e_sele->bindParam(':sub_id',$sub_id);
            $e_sele->bindParam(':min',$min);
            $e_sele->execute();
            if($e_sele->rowCount()==1){
                $i++;
            }
        }

        if($i>=1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Academic program subject already exist
	              	</div>
              	</div>
            </div>';
        }
        else{
            foreach ($_POST['sub_id'] as $sub_id){
            // Insert image file name into database 
            $insert = "INSERT INTO tbl_acadcon(acad_id,grade_id,sub_id,min)VALUES(:acad_id,:grade_id,:sub_id,:min)";
            $inserts= $db->prepare($insert);
            $inserts->bindParam(':acad_id',$acad_id);
            $inserts->bindParam(':grade_id',$grade_id);
            $inserts->bindParam(':sub_id',$sub_id);
            $inserts->bindParam(':min',$min);
            $inserts->execute();
            }
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