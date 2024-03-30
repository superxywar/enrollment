<?php
	session_start();
	ob_start();
	
	$database ='ipilsdac_db';
	$host 	  ='localhost';
	$user	  ='ipilsdac';
	$pass	  ='4)8ou89w;EACQi';
	
	try{
		$db =new PDO("mysql:dbname={$database};host={$host}",$user,$pass);
	
	}
	catch(PDOExcemption $e){
		echo'Error'.$e->getMessage();
	}
?>