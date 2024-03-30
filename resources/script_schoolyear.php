<?php
    if(isset($_POST['btn_save'])){

        $start = $_POST['start'];
        $end   = $_POST['end'];
        $status= 'Inactive';

        $e_sel = "SELECT * FROM tbl_schoolyear WHERE start_year=:start_year AND end_year=:end_year";
        $e_sele= $db->prepare($e_sel);
        $e_sele->bindParam(':start_year',$start);
        $e_sele->bindParam(':end_year',$end);
        $e_sele->execute();

        if($e_sele->rowCount()==1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                School year already exist
	              	</div>
              	</div>
            </div>';
        }
        else{

            
            $insert = "INSERT INTO tbl_schoolyear(start_year,end_year,status)VALUES(:start_year,:end_year,:status)";
            $inserts= $db->prepare($insert);
            $inserts->bindParam(':start_year',$start);
            $inserts->bindParam(':end_year',$end);
            $inserts->bindParam(':status',$status);
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