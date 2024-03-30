<?php
    if(isset($_POST['btn_save'])){

        $title          = $_POST['title'];
        $description    = $_POST['description'];
        $date           = date('Y-m-d');
        $event_date     = $_POST['date'];
        $e_sel = "SELECT * FROM tbl_event WHERE event_title=:event_title";
        $e_sele= $db->prepare($e_sel);
        $e_sele->bindParam(':event_title',$title);
        $e_sele->execute();

        if($e_sele->rowCount()==1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Event already exist
	              	</div>
              	</div>
            </div>';
        }
        else{
                
			// Insert image file name into database 
            $insert = "INSERT INTO tbl_event(event_date,event_title,description,date)VALUES(:event_date,:event_title,:description,:date)";
            $inserts= $db->prepare($insert);
            $inserts->bindParam(':event_date',$event_date);
            $inserts->bindParam(':event_title',$title);
            $inserts->bindParam(':description',$description);
            $inserts->bindParam(':date',$date);
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