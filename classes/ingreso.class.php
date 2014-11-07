<?php

include "conexion.class.php";

class Ingreso{
	
	private $nuevo;
	private $cambios;
	private $id;
	private $elemento;
	private $cantidad;
	private $fecha;
	private $expediente;
	private $comentario;
	
	function __construct(){
		$this->nuevo = true;
		$this->cambios = true;
		$this->id = 0;
		$this->elemento = "";
		$this->cantidad = 0;
		$this->fecha = "";
		$this->expediente = "";
		$this->comentario = "";
	}
	
	//INICIO METODOS ESTATICOS
	
	static function ingreso($id){
		//Metodo estatico que retorna un ingreso que posea el $legajo
		
		$i = new Ingreso();
		
		$conn = new Conexion();
		
		$sql = 'SELECT * FROM ingreso WHERE id = :id';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		$consulta->bindParam(':id', $id, PDO::PARAM_STR);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetch();
			
			$i->id = $results['id'];
			$i->elemento = $results['elemento'];
			$i->cantidad = $results['cantidad'];
			$i->fecha = $results['fecha'];
			$i->expediente = $results['expediente'];
			$i->comentario = $results['comentario'];
			$i->nuevo = false;
			$i->cambios = false;
			
		}catch(PDOException $ex){
			
		}
		
		return $i;
	}
	
	static function ingresos(){
		//METODO ESTATICO QUE RETORNA TODOS LOS ingresoS DE LA BASE
		
		$is = array();
		
		$conn = new Conexion();
		
		$sql = 'SELECT id FROM ingreso';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetchall();
			
			foreach($results as $r){
				
				$i = Ingreso::ingreso($r['id']);
				
				array_push($is, $i);
			}
			
		}catch(PDOException $ex){
			
		}
		
		return $is;
	}
	
	//INICIO METODOS DE CLASE
	
	function guardar(){
		//Metodo de clase que guarda un ingreso en la base
		
		if(!$this->cambios)//Si no hay cambios en el objeto
			return;
		
		if($this->elemento == "")
			throw new Exception("El elemento no es válido.");
		
		if($this->cantidad <= 0)
			throw new Exception("La cantidad no es válida.");
		
		if($this->fecha == "")
			throw new Exception("La fecha no es válida.");
		
		if($this->expediente == "")
			throw new Exception("El número de expediente no es válido.");
		
		$conn = new Conexion();
		
		if($this->nuevo){//Si el objeto es nuevo se hace un INSERT
			
			try{
				$sql = "INSERT INTO ingreso(elemento, cantidad, fecha, expediente, comentario)
						VALUES(:elemento, :cantidad, :fecha, :expediente, :comentario)";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':elemento', $this->elemento, PDO::PARAM_STR);
				$stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
				$stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
				$stmt->bindParam(':expediente', $this->expediente, PDO::PARAM_STR);
				$stmt->bindParam(':comentario', $this->comentario, PDO::PARAM_STR);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				throw new Exception("No me pude guardar como ingreso: ". $ex->getMessage());
			}
			
		}
		else{//Si el objeto no es nuevo se hace un UPDATE
			
			try{
				$sql = "UPDATE ingreso SET elemento = :elemento, cantidad = :cantidad, fecha = :fecha, expediente = :expediente, comentario = :comentario
						WHERE id = :id";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':elemento', $this->elemento, PDO::PARAM_STR);
				$stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
				$stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
				$stmt->bindParam(':expediente', $this->expediente, PDO::PARAM_STR);
				$stmt->bindParam(':comentario', $this->comentario, PDO::PARAM_STR);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				throw new Exception("Ocurrió un error mientras me actualizaba: ". $ex->getMessage());
			}
			
		}
		
	}
	
	function eliminar(){
		//Metodo de clase que elimina un ingreso de la base
		
		if(!$this->nuevo)
			return;
		
		if($this->id == 0)
			return;
		
		try{
			$sql = "DELETE FROM ingreso WHERE id = :id";
			
			$stmt = $conn->prepare($sql);
			
			$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
			
			$stmt->execute();
			
		} catch(PDOException $ex){
			throw new Exception("No pude eliminarme de la base: ". $ex->getMessage());
		}
		
	}
	
	//INICIO METODOS GETTERS Y SETTERS
	
	function getId(){
		return $this->id;
	}
	
	function getElemento(){
		return $this->elemento;
	}
	
	function setElemento($elemento){
		
		if($elemento == "")
			return;
		
		$this->elemento = $elemento;
		$this->cambios = true;
	}
	
	function getCantidad(){
		return $this->cantidad;
	}
	
	function setCantidad($cantidad){
		
		if($cantidad <= 0)
			return;
		
		$this->cantidad = $cantidad;
		$this->cambios = true;
	}
	
	function getFecha(){
		return $this->fecha;
	}
	
	function setFecha($fecha){
		
		if($fecha == "")
			return;
		
		$this->fecha = $fecha;
		$this->cambios = true;
	}
	
	function getExpediente(){
		return $this->expediente;
	}
	
	function setExpediente($expediente){
		
		if($expediente == "")
			return;
		
		$this->expediente = $expediente;
		$this->cambios = true;
	}
	
	function getComentario(){
		return $this->comentario;
	}
	
	function setComentario($comentario){
		
		if($comentario == "")
			return;
		
		$this->comentario = $comentario;
		$this->cambios = true;
	}
	
}
