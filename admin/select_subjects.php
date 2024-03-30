<?php 
	require_once'../../database/dbconfig.php';
	
	$country=	$_GET['country'];

	

	$query	=	"SELECT * FROM tbl_section WHERE grade_id=:grade_id";
	$queries= $db->prepare($query);
	$queries->bindParam(':grade_id',$country);
	$queries->execute();
	

?>
<select  name="state" class="form-control select2" required>
	<option value="">Select Section</option>
<?php 
	while($row=$queries->fetch()){
	    
        $h_sel = "SELECT teach_id FROM tbl_schedule WHERE sy_id=:sy_id AND section_id=:section_id GROUP BY teach_id";
		$h_sele= $db->prepare($h_sel);
		$h_sele->bindParam(':sy_id',$_SESSION['sy_id']);
		$h_sele->bindParam(':section_id',$row['section_id']);
		$h_sele->execute();
		$h_row = $h_sele->fetch();

		$b_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_teacher WHERE teach_id=:teach_id";
		$b_sele= $db->prepare($b_sel);
		$b_sele->bindParam(':teach_id',$h_row['teach_id']);
		$b_sele->execute();
		$b_row = $b_sele->fetch();
?>
	<option value="<?php echo $row['section_id'];?>"><?php echo $row['section'];?> ADVISER : <?php echo $b_row['name']?></option>
<?php 
	} 
?>
</select>
