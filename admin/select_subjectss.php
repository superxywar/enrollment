<?php 
	require_once'../../database/dbconfig.php';
	
	$country=	$_GET['country'];

	

	$query	=	"SELECT * FROM tbl_section WHERE grade_id=:grade_id";
	$queries= $db->prepare($query);
	$queries->bindParam(':grade_id',$country);
	$queries->execute();
	

?>
<select  name="state" class="form-control" required>
	<option value="">Select Section</option>
<?php 
	while($row=$queries->fetch()){
		
?>
	<option value="<?php echo $row['section_id'];?>"><?php echo $row['section'];?></option>
<?php 
	} 
?>
</select>
