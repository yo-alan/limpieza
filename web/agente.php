<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		
		$accion = "";
		
		if(isset($_GET['action']))
			$accion = $_GET['action'];
		else{
			
		}
		
		if($accion == 'agregar'){
			include "../templates/agente/agregar.php";
		}
		else{
			
		}
		
		die();
	}
	
	if(!isset($_POST['action']))
		header("Location: index.php");
	
	$accion = $_POST['action'];
	
	if($accion == 'agregar')
		agregar();
	
	
	function agregar(){
		
		include_once "../classes/agente.class.php";
		
		$estado = "success";
		$mensaje = "El agente se guardó exitosamente.";
		
		try{
			
			$a = new Agente();
			
			$a->setNombre($_POST['nombre']);
			$a->setApellido($_POST['apellido']);
			
			$a->guardar();
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
		}
		
		header("Location: index.php?estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	