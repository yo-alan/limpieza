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
		else if($accion == 'historialIngreso'){
			include_once "../classes/ingreso.class.php";
			
			$is = Ingreso::ingresos();
			
			include "../templates/elemento/historialIngreso.php";
		}
		else if($accion == 'historialRetiro'){
			include_once "../classes/retiro.class.php";
			
			$rs = Retiro::retiros();
			
			include "../templates/elemento/historialRetiro.php";
		}
		else if($accion == 'modificarIngreso'){
			include_once "../classes/ingreso.class.php";
			
			if(!isset($_GET['id'])){
				
				$is = Ingreso::ingresos();
				
				include "../templates/elemento/historialIngreso.php";
				die();
			}
			
			include_once "../classes/elemento.class.php";
			
			$es = Elemento::elementos();
			$i = Ingreso::ingreso($_GET['id']);
			
			include "../templates/elemento/modificarIngreso.php";
		}
		else if($accion == 'modificarRetiro'){
			include_once "../classes/retiro.class.php";
			
			if(!isset($_GET['id'])){
				
				$rs = Retiro::retiros();
				
				include "../templates/elemento/historialRetiro.php";
				die();
			}
			
			include_once "../classes/elemento.class.php";
			
			$es = Elemento::elementos();
			$as = Agente::agentes();
			$r = Retiro::retiro($_GET['id']);
			
			include "../templates/elemento/modificarRetiro.php";
		}
		else{
			include_once "../classes/elemento.class.php";
			
			$es = Elemento::elementos();
			
			include "../templates/elemento/stock.php";
		}
		
		die();
	}
	
	if(!isset($_POST['action']))
		header("Location: index.php");
	
	$accion = $_POST['action'];
	
	if($accion == 'ingreso')
		ingreso();
	else if($accion == 'modificarIngreso')
		modificarIngreso();
	else if($accion == 'retiro')
		retiro();
	else if($accion == 'modificarRetiro')
		modificarRetiro();
	
	
	function ingreso(){
		
		include_once "../classes/ingreso.class.php";
		
		$estado = "success";
		$mensaje = "El ingreso se registró exitosamente.";
		
		try{
			
			$i = new Ingreso();
			
			$i->setElemento($_POST['elemento']);
			$i->setCantidad($_POST['cantidad']);
			$i->setFecha($_POST['fecha']);
			$i->setExpediente($_POST['expediente']);
			$i->setComentario($_POST['comentario']);
			
			$i->guardar();
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
		}
		
		header("Location: elemento.php?action=ingreso&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
	function modificarIngreso(){
		
		include_once "../classes/ingreso.class.php";
		
		$estado = "success";
		$mensaje = "El ingreso se modificó exitosamente.";
		
		try{
			
			$i = Ingreso::ingreso($_POST['id']);
			
			$i->setElemento($_POST['elemento']);
			$i->setCantidad($_POST['cantidad']);
			$i->setFecha($_POST['fecha']);
			$i->setExpediente($_POST['expediente']);
			$i->setComentario($_POST['comentario']);
			
			$i->guardar();
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
		}
		
		header("Location: elemento.php?action=modificarIngreso&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
	function retiro(){
		
		include_once "../classes/retiro.class.php";
		
		$estado = "success";
		$mensaje = "El retiro se registró exitosamente.";
		
		try{
			
			$r = new Retiro();
			
			$r->setAgente($_POST['agente']);
			$r->setElemento($_POST['elemento']);
			$r->setFecha($_POST['fecha']);
			$r->setCantidad($_POST['cantidad']);
			$r->setComentario($_POST['comentario']);
			
			$r->guardar();
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
		}
		
		header("Location: elemento.php?action=retiro&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
	function modificarRetiro(){
		
		include_once "../classes/retiro.class.php";
		include_once "../classes/elemento.class.php";
		include_once "../classes/agente.class.php";
		
		$estado = "success";
		$mensaje = "El retiro se modificó exitosamente.";
		
		try{
			
			$r = Retiro::retiro($_POST['id']);;
			
			$r->setAgente(Agente::agente($_POST['agente']));
			$r->setElemento(Elemento::elemento($_POST['elemento']));
			$r->setFecha($_POST['fecha']);
			$r->setCantidad($_POST['cantidad']);
			$r->setComentario($_POST['comentario']);
			
			$r->guardar();
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
		}
		
		header("Location: elemento.php?action=modificarRetiro&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
