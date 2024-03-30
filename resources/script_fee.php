<?php
    if(isset($_POST['btn_save'])){

        $grade_id = $_POST['grade_id'];
        $fee  = strtoupper($_POST['fee']);
        $sy_id    = $_SESSION['sy_id'];
        $amount   = $_POST['amount'];

        $i=0;
        foreach ($_POST['grade_id'] as $grade_id){
            $e_sel = "SELECT * FROM tbl_fee WHERE sy_id=:sy_id AND grade_id=:grade_id AND fee=:fee AND amount=:amount";
            $e_sele= $db->prepare($e_sel);
            $e_sele->bindParam(':sy_id',$sy_id);
            $e_sele->bindParam(':grade_id',$grade_id);
            $e_sele->bindParam(':fee',$fee);
            $e_sele->bindParam(':amount',$amount);
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
		                Fee already exist
	              	</div>
              	</div>
            </div>';
        }
        else{
            foreach ($_POST['grade_id'] as $grade_id)
			{   
                
				// Insert image file name into database 
                $insert = "INSERT INTO tbl_fee(sy_id,grade_id,fee,amount)VALUES(:sy_id,:grade_id,:fee,:amount)";
                $inserts= $db->prepare($insert);
                $inserts->bindParam(':sy_id',$sy_id);
                $inserts->bindParam(':grade_id',$grade_id);
                $inserts->bindParam(':fee',$fee);
                $inserts->bindParam(':amount',$amount);
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