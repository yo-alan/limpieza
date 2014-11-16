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
		ingreso();
	
	
	function ingreso(){
		
		include "../classes/ingreso.class.php";
		
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
	
