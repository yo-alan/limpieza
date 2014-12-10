<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	header('Content-type: text/html; charset=utf-8');
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		
		$accion = "";
		
		if(isset($_GET['action']))
			$accion = $_GET['action'];
		
		if($accion == 'agregar'){
			include "../templates/usuario/agregar.php";
		}
		else if($accion == 'editar'){
			
			if(!(isset($_GET['id']) && $_GET['id'] > 0))
				header("Location: usuario.php");
			
			include_once "../classes/usuario.class.php";
			
			$u = Usuario::usuario($_GET['id']);
			
			include "../templates/usuario/editar.php";
		}
		else if($accion == 'entrar'){
			include "../templates/usuario/entrar.php";
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
	else if($accion == 'eliminar')
		eliminar();
	else if($accion == 'entrar')
		entrar();
	
	
	function agregar(){
		
		include_once "../classes/usuario.class.php";
		
		$estado = "success";
		$mensaje = "El usuario se guardó exitosamente.";
		
		try{
			
			$u = new Usuario();
			
			$u->setNombre($_POST['nombre']);
			$u->setContrasena($_POST['contrasena']);
			$u->setNivel($_POST['nivel']);
			
			$u->guardar();
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
		}
		
		header("Location: usuario.php?action=agregar&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
	function editar(){
		
		include_once "../classes/usuario.class.php";
		
		$estado = "success";
		$mensaje = "El usuario se modificó exitosamente.";
		
		try{
			
			$u = Usuario::usuario($_POST['id']);
			
			$u->setNombre($_POST['nombre']);
			$u->setContrasena($_POST['contrasena']);
			$u->setNivel($_POST['nivel']);
			
			$u->guardar();
			
		} catch(Exception $ex){
			$estado = "danger";
			$mensaje = $ex->getMessage();
		}
		
		header("Location: usuario.php?action=editar&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
	function eliminar(){
		
		include_once "../classes/usuario.class.php";
		
		$estado = "success";
		$mensaje = "El usuario se eliminó exitosamente.";
		
		try{
			
			$u = Usuario::usuario($_POST['id']);
			
			$u->eliminar();
			
		} catch(Exception $ex){
			$estado = "danger";
			$mensaje = $ex->getMessage();
		}
		
		header("Location: usuario.php?action=editar&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
	function entrar(){
		
		include_once "../classes/usuario.class.php";
		
		if("" != $_POST['nombre'] && "" != $_POST['contrasena']){
			
			include_once "../classes/usuario.class.php";
			
			$u = Usuario::usuario($_POST['nombre'], $_POST['contrasena']);
			
			if($u->getNombre() != ""){
				
				session_start();
				
				$_SESSION['usuario'] = $u->getNombre();
				$_SESSION['nivel'] = $u->getNivel();
				
				header("Location: index.php");
			}
			else{
				
				$estado = "danger";
				$mensaje = "El nombre de usuario o la contraseña son incorrectos.";
				
				header("Location: usuario.php?action=entrar&estado=". $estado. "&mensaje=". $mensaje);
			}
			
			die();
		}
	}
