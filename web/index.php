<?php
	if(isset($_GET['estado'])){
		
		$estado = $_GET['estado'];
		$mensaje = $_GET['mensaje'];
		
		include "../templates/index.php";
		
		die();
	}
	
	include "../templates/index.php";
	
