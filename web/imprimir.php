<?php
	
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	include_once "../classes/elemento.class.php";
	
	include_once '../ezPDF/class.ezpdf.php';
	
	$pdf = new Cezpdf('a4','portiat');
	$pdf->selectFont('../ezPDF/fonts/Helvetica.afm');
	
	$dato = Elemento::imprimir();
	$pdf->ezTable($dato);
	
	$pdf->ezStream();
	
