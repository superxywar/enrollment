<?php
	if(isset($_GET['page'])){
		if($_GET['page']=='page')
			$_SESSION['PAGE']= 1;
		
		$touch = $_GET['page'].'.php';
		$show=1;
		
		
	}
?>