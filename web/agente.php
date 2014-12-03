<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	header('Content-type: text/html; charset=utf-8');
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		
		$accion = "";
		
		if(isset($_GET['action']))
			$accion = $_GET['action'];
		else{
			
		}
		
		if($accion == 'agregar'){
			include "../templates/agente/agregar.php";
		}
		else if($accion == 'editar'){
			
			if(!(isset($_GET['id']) && $_GET['id'] > 0))
				header("Location: agente.php");
			
			include_once "../classes/agente.class.php";
			
			$a = Agente::agente($_GET['id']);
			
			include "../templates/agente/editar.php";
		}
		else if($accion == 'listado'){
			include_once "../classes/agente.class.php";
			
			$as = Agente::agentes();
			
			include "../templates/agente/listado.php";
		}
		else{
			header("Location: index.php");
		}
		
		die();
	}
	
	if(!isset($_POST['action']))
		header("Location: index.php");
	
	$accion = $_POST['action'];
	
	if($accion == 'agregar')
		agregar();
	else if($accion == 'editar')
		editar();
	
	
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
		
		header("Location: agente.php?action=agregar&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
	function editar(){
		
		include_once "../classes/agente.class.php";
		
		$estado = "success";
		$mensaje = "El agente se modificó exitosamente.";
		
		try{
			
			$a = Agente::agente($_POST['id']);
			
			$a->setNombre($_POST['nombre']);
			$a->setApellido($_POST['apellido']);
			
			$a->guardar();
			
		} catch(Exception $ex){
			$estado = "danger";
			$mensaje = $ex->getMessage();
		}
		
		header("Location: agente.php?action=editar&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
