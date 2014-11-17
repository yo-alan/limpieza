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
			include_once "../classes/elemento.class.php";
			
			$es = Elemento::elementos();
			
			include "../templates/elemento/ingreso.php";
		}
		else if($accion == 'retiro'){
			include_once "../classes/elemento.class.php";
			include_once "../classes/agente.class.php";
			
			$es = Elemento::elementos();
			$as = Agente::agentes();
			
			include "../templates/elemento/retiro.php";
		}
		else{
			
		}
		
		die();
	}
	
	if(!isset($_POST['action']))
		header("Location: index.php");
	
	$accion = $_POST['action'];
	
	if($accion == 'ingreso')
		ingreso();
	else if($accion == 'retiro')
		retiro();
	
	
	function ingreso(){
		
		include_once "../classes/ingreso.class.php";
		
		$estado = "success";
		$mensaje = "El ingreso se registró exitosamente.";
		
		$i = new Ingreso();
		
		$i->setElemento($_POST['elemento']);
		$i->setCantidad($_POST['cantidad']);
		$i->setFecha($_POST['fecha']);
		$i->setExpediente($_POST['expediente']);
		$i->setComentario($_POST['comentario']);
		
		try{
			
			$i->guardar();
			
			header("Location: index.php?estado=". $estado. "&mensaje=". $mensaje);
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
			header("Location: index.php?estado=". $estado. "&mensaje=". $mensaje);
		}
		
		die();
	}
	
	function retiro(){
		
		include_once "../classes/retiro.class.php";
		
		$estado = "success";
		$mensaje = "El retiro se registró exitosamente.";
		
		$r = new Retiro();
		
		$r->setAgente($_POST['agente']);
		$r->setElemento($_POST['elemento']);
		$r->setFecha($_POST['fecha']);
		$r->setCantidad($_POST['cantidad']);
		$r->setComentario($_POST['comentario']);
		
		try{
			
			$r->guardar();
			
			header("Location: index.php?estado=". $estado. "&mensaje=". $mensaje);
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
			header("Location: index.php?estado=". $estado. "&mensaje=". $mensaje);
		}
		
		die();
	}
	
