<?php
    
    if(isset($_POST['btn_save'])){

       
        $level     = $_POST['level'];
        $year      = $_POST['year'];
        $name      = $_POST['name'];

        if(empty($_POST['degree'])){
            $degree    = '';
        }
        else{
            $degree    = $_POST['degree'];
        }
        if($level=='Primary'){
            $no    = '1';
        }
        elseif($level=='Secondary'){
            $no    = '2';
        }
        elseif($level=='Tertiary'){
            $no    = '3';
        }
        elseif($level=='Vocational'){
            $no    = '4';
        }
        else{
            $no    = '5';
        }
        $teach_id  = $_POST['teach_id'];


        $select = "SELECT * FROM tbl_teacheduc WHERE teach_id=:teach_id AND level_school=:level_school AND year_graduated=:year_graduated AND name_school=:name_school AND degree=:degree";
        $selects= $db->prepare($select);
        $selects->bindParam(':teach_id',$teach_id);
        $selects->bindParam(':level_school',$level);
        $selects->bindParam(':year_graduated',$year);
        $selects->bindParam(':name_school',$name);
        $selects->bindParam(':degree',$degree);
        $selects->execute();

        if($selects->rowCount()>=1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Data already exist
	              	</div>
              	</div>
            </div>';
        }
        else{
            $insert = "INSERT INTO tbl_teacheduc(teach_id,level,level_school,year_graduated,name_school,degree)VALUES(:teach_id,:level,:level_school,:year_graduated,:name_school,:degree)";
            $insert= $db->prepare($insert);
            $insert->bindParam(':teach_id',$teach_id);
            $insert->bindParam(':level',$no);
            $insert->bindParam(':level_school',$level);
            $insert->bindParam(':year_graduated',$year);
            $insert->bindParam(':name_school',$name);
            $insert->bindParam(':degree',$degree);
            $insert->execute();

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
    if(isset($_POST['btn_saves'])){

        $name       = $_POST['name'];
        $rating     = $_POST['rating'];
        $date_exam  = $_POST['date_exam'];
        $place      = $_POST['place'];
        $license    = $_POST['license'];
        $date_valid = $_POST['date_valid'];

        $teach_id   = $_POST['teach_id'];

        $select = "SELECT * FROM tbl_teacheli WHERE teach_id=:teach_id AND eligibility=:eligibility";
        $selects= $db->prepare($select);
        $selects->bindParam(':teach_id',$teach_id);
        $selects->bindParam(':eligibility',$name);
        $selects->execute();

        if($selects->rowCount()>=1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Data already exist
	              	</div>
              	</div>
            </div>';
        }
        else{
            $insert = "INSERT INTO tbl_teacheli(teach_id,eligibility,rating,date_exam,place,license_number,date_validity)VALUES(:teach_id,:eligibility,:rating,:date_exam,:place,:license_number,:date_validity)";
            $insert= $db->prepare($insert);
            $insert->bindParam(':teach_id',$teach_id);
            $insert->bindParam(':eligibility',$name);
            $insert->bindParam(':rating',$rating);
            $insert->bindParam(':date_exam',$date_exam);
            $insert->bindParam(':place',$place);
            $insert->bindParam(':license_number',$license);
            $insert->bindParam(':date_validity',$date_valid);
            $insert->execute();

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