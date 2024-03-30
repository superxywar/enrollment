<?php
    //declaration of student no number
	$query ="SELECT * FROM tbl_studentpay ORDER BY studpay_id ASC";
	$querys= $db->prepare($query);
	$querys->execute();
	if($querys->rowCount()>=1){
	while($row=$querys->fetch()){
		$date2=$row['or_no'];
		$date1= date('Y');
		$month= date('m');
		$val = explode("-",$date2);
		$val[1];
		$new = $val[1]+1;
		$new = (string)$new;

		$con = strlen($new);
		
		for($j=1;$j<=3-$con;$j++){
		$new = '0'.$new;
		}
		
	
	 
		}	
		 $orno =  $date1.$month.'-'.$new;
		}
	else{
	
		$date1= date('Y');
		$month= date('m');
		$date=  $date1.$month.'-001';
		
		$orno = $date;
	}
?>