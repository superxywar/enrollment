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
		$gg_sel = "SELECT * FROM tbl_section WHERE grade_id=:grade_id";
		$gg_sele= $db->prepare($gg_sel);
		$gg_sele->bindParam(':grade_id',$row['grade_id']);
		$gg_sele->execute();
		$gg_row = $gg_sele->fetch();

?>
	<option value="<?php echo $row['section_id'];?>"><?php echo $gg_row['section'];?></option>
<?php 
	} 
?>
</select>
