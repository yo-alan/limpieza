<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		
		$accion = "";
		
		if(isset($_GET['action']))
			$accion = $_GET['action'];
		else{
			
		}
		
		
		if($accion == 'ingreso'){
			include "../classes/elemento.class.php";
			
			$es = Elemento::elementos();
			
			include "../templates/elemento/ingreso.php";
		}
		else{
			
		}
		
		die();
	}
	
	if(!isset($_POST['action']))
		header("Location: index.php");
	
	$accion = $_POST['action'];
	
	if($accion == 'ingreso')
		agregar();
	
	
	function ingreso(){
		
		$estado = "success";
		$mensaje = "Todo resulto exitosamente!!!";
		
		header("Location: index.php?estado=". $estado. "&mensaje=". $mensaje);
		die();
	}
	
