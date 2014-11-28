<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	include_once "../classes/elemento.class.php";
		
	$es = Elemento::elementos();
	
	if(isset($_GET['estado'])){
		
		$estado = $_GET['estado'];
		$mensaje = $_GET['mensaje'];
		
		include "../templates/index.php";
		
		die();
	}
	
	include "../templates/index.php";
	
