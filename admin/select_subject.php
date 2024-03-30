<?php 
	require_once'../../database/dbconfig.php';
	
	$country=	$_GET['country'];

	$aa_sel = "SELECT * FROM tbl_academic WHERE status='Active'";
    $aa_sele= $db->prepare($aa_sel);
    $aa_sele->execute();
    $aa_row = $aa_sele->fetch(); 
	
	

	$query	=	"SELECT * FROM tbl_acadcon WHERE acad_id=:acad_id AND grade_id=:grade_id";
	$queries= $db->prepare($query);
	$queries->bindParam(':acad_id',$aa_row['acad_id']);
	$queries->bindParam(':grade_id',$country);
	$queries->execute();
	

?>
<select  name="state" class="form-control select2" required>
	<option value="">Select Subject</option>
<?php 
	while($row=$queries->fetch()){
		$gg_sel = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
		$gg_sele= $db->prepare($gg_sel);
		$gg_sele->bindParam(':sub_id',$row['sub_id']);
		$gg_sele->execute();
		$gg_row = $gg_sele->fetch();

?>
	<option value="<?php echo $row['sub_id'];?>"><?php echo $gg_row['subject'];?></option>
<?php 
	} 
?>
</select>
