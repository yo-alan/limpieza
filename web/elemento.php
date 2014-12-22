<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	session_start();
	
	if(!isset($_SESSION['usuario'])){
		 include "../templates/usuario/entrar.php";
		die();
	}
	
	header('Content-type: text/html; charset=utf-8');
	
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
		else if($accion == 'imprimirStock'){
			
			require_once '../classes/fpdf.php';
			require_once '../classes/elemento.class.php';
			
			class PDF extends FPDF{
				
				// Better table
				function ImprovedTable($header, $data){
					// Column widths
					$w = array(70, 45, 30);
					// Header
					for($i=0;$i<count($header);$i++)
						$this->Cell($w[$i],7,$header[$i],1,0,'C');
					$this->Ln();
					$this->SetFont('Arial','',10);
					// Data
					foreach($data as $row){
						$this->Cell($w[0],6,$row[0],1);
						$this->Cell($w[1],6,$row[1],1);
						$this->Cell($w[2],6,number_format($row[2]),1,0,'R');
						$this->Ln();
					}
					// Closing line
					$this->Cell(array_sum($w),0,'','T');
				}
				
				function Footer(){
					// Position at 1.5 cm from bottom
					$this->SetY(-15);
					// Arial italic 8
					$this->SetFont('Arial','I',12);
					// Page number
					$fecha = getDate();
					$fecha = date("Y-m-d", strtotime($fecha["year"]. "-". $fecha["mon"]. "-". $fecha["mday"]));
					$this->Cell(0,10,utf8_decode('Fecha de emisión: '. $fecha. "."),0,0,'C');
				}
			}

			$pdf = new PDF();
			// Column headings
			$header = array('Elemento', 'Unidad de medida', 'Cantidad');
			// Data loading
			$data = Elemento::imprimir();
			$pdf->SetFont('Arial','B',12);
			$pdf->AddPage();
			$pdf->ImprovedTable($header,$data);
			$pdf->Output();
			
		}
		else if($accion == 'imprimirRetiros'){
			
			require_once '../classes/fpdf.php';
			require_once '../classes/retiro.class.php';
			
			class PDF extends FPDF{
				
				// Better table
				function ImprovedTable($header, $data){
					// Column widths
					$w = array(35, 65, 20, 20, 50);
					// Header
					for($i=0;$i<count($header);$i++)
						$this->Cell($w[$i],7,$header[$i],1,0,'C');
					$this->Ln();
					$this->SetFont('Arial','',10);
					// Data
					foreach($data as $row){
						$this->Cell($w[0],6,$row[0],1);
						$this->Cell($w[1],6,$row[1],1);
						$this->Cell($w[2],6,$row[2],1);
						$this->Cell($w[3],6,number_format($row[3]),1,0,'R');
						$this->Cell($w[4],6,$row[4],1);
						$this->Ln();
					}
					// Closing line
					$this->Cell(array_sum($w),0,'','T');
				}
				
				function Footer(){
					// Position at 1.5 cm from bottom
					$this->SetY(-15);
					// Arial italic 8
					$this->SetFont('Arial','I',12);
					// Page number
					$fecha = getDate();
					$fecha = date("Y-m-d", strtotime($fecha["year"]. "-". $fecha["mon"]. "-". $fecha["mday"]));
					$this->Cell(0,10,utf8_decode('Fecha de emisión: '. $fecha. "."),0,0,'C');
				}
			}

			$pdf = new PDF();
			// Column headings
			$header = array('Agente', 'Elemento', 'Fecha', 'Cantidad', 'Comentario');
			// Data loading
			$data = Retiro::imprimir();
			$pdf->SetFont('Arial','B',12);
			$pdf->AddPage();
			$pdf->ImprovedTable($header,$data);
			$pdf->Output();

		}
		else{
			header("Location: index.php");
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
			$i->setFecha_hora(date('Y-m-d H:i:s'));
			$i->setExpediente($_POST['expediente']);
			$i->setUsuario($_SESSION['id']);
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
			$i->setFecha_hora(date('Y-m-d H:i:s'));
			$i->setExpediente($_POST['expediente']);
			$i->setUsuario($_SESSION['id']);
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
			$r->setFecha_hora(date('Y-m-d H:i:s'));
			$r->setCantidad($_POST['cantidad']);
			$r->setUsuario($_SESSION['id']);
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
			$r->setFecha_hora(date('Y-m-d H:i:s'));
			$r->setCantidad($_POST['cantidad']);
			$r->setUsuario($_SESSION['id']);
			$r->setComentario($_POST['comentario']);
			
			$r->guardar();
			
		} catch(Exception $ex){
			
			$estado = "danger";
			$mensaje = $ex->getMessage();
			
		}
		
		header("Location: elemento.php?action=modificarRetiro&estado=". $estado. "&mensaje=". $mensaje);
		
		die();
	}
	
