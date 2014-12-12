<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	session_start();
	
	if(!isset($_SESSION['usuario'])){
		header("Location: usuario.php?action=entrar");
		die();
	}
	
	header('Content-type: text/html; charset=utf-8');
	
	include_once "../classes/elemento.class.php";
	
	$es = Elemento::elementos();
	
	if(isset($_GET['estado'])){
		
		$estado = $_GET['estado'];
		$mensaje = $_GET['mensaje'];
		
		include "../templates/index.php";
		
		die();
	}
	
	include "../templates/index.php";
	
