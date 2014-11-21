<?php

require_once "conexion.class.php";
require_once "agente.class.php";
require_once "elemento.class.php";

class Retiro{
	
	private $nuevo;
	private $cambios;
	private $id;
	private $agente;
	private $elemento;
	private $fecha;
	private $cantidad;
	private $comentario;
	
	function __construct(){
		$this->nuevo = true;
		$this->cambios = true;
		$this->id = 0;
		$this->agente = null;
		$this->elemento = null;
		$this->fecha = "";
		$this->cantidad = 0;
		$this->comentario = "";
	}
	
	//INICIO METODOS ESTATICOS
	
	static function retiro($id){
		//Metodo estatico que retorna un retiro que posea el $id
		
		$r = new Retiro();
		
		$conn = new Conexion();
		
		$sql = 'SELECT * FROM retiro WHERE id = :id';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		$consulta->bindParam(':id', $id, PDO::PARAM_INT);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetch();
			
			$r->id = $results['id'];
			$r->agente = $results['agente'];
			$r->elemento = $results['elemento'];
			$r->fecha = $results['fecha'];
			$r->cantidad = $results['cantidad'];
			$r->comentario = $results['comentario'];
			$r->nuevo = false;
			$r->cambios = false;
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo el retiro: ". $ex->getMessage());
		}
		
		return $a;
	}
	
	static function retiros(){
		//METODO ESTATICO QUE RETORNA TODOS LOS RETIROS DE LA BASE
		
		$rs = array();
		
		$conn = new Conexion();
		
		$sql = 'SELECT id FROM retiro';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetchall();
			
			foreach($results as $r){
				
				$rt = Retiro::retiro($r['id']);
				
				array_push($rs, $rt);
			}
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo los retiros: ". $ex->getMessage());
		}
		
		return $rs;
	}
	
	//INICIO METODOS DE CLASE
	
	function guardar(){
		//Metodo de clase que guarda un retiro en la base
		
		if(!$this->cambios)//Si no hay cambios en el objeto
			return;
		
		if($this->agente == null)
			throw new Exception("El agente no es válido.");
		
		if($this->elemento == null)
			throw new Exception("EL elemento no es válida.");
		
		if($this->fecha == "")
			throw new Exception("La fecha no es válida.");
		
		if($this->cantidad == "")
			throw new Exception("La cantidad no es válida.");
		
		$conn = new Conexion();
		
		if($this->nuevo){//Si el objeto es nuevo se hace un INSERT
			
			try{
				$sql = "INSERT INTO retiro(agente, elemento, fecha, cantidad, comentario)
						VALUES(:agente, :elemento, :fecha, :cantidad, :comentario)";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':agente', $this->agente->getId(), PDO::PARAM_INT);
				$stmt->bindParam(':elemento', $this->elemento->getId(), PDO::PARAM_INT);
				$stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
				$stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
				$stmt->bindParam(':comentario', $this->comentario, PDO::PARAM_STR);
				
				$e = Elemento::elemento($this->elemento->getNombre());
				
				$e->setStock($e->getStock() - $this->cantidad);
				
				$e->guardar();
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				
				throw new Exception("No me pude guardar como retiro: ". $ex->getMessage());
			}
			
		}
		else{//Si el objeto no es nuevo se hace un UPDATE
			
			try{
				$sql = "UPDATE retiro SET agente = :agente, elemento = :elemento, fecha = :fecha, cantidad = :cantidad, comentario = :comentario
						WHERE id = :id";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':agente', $this->agente->getId(), PDO::PARAM_INT);
				$stmt->bindParam(':elemento', $this->elemento->getId(), PDO::PARAM_INT);
				$stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
				$stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
				$stmt->bindParam(':comentario', $this->comentario, PDO::PARAM_STR);
				$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				
				throw new Exception("Ocurrió un error mientras me actualizaba: ". $ex->getMessage());
			}
		}
	}
	
	function eliminar(){
		//Metodo de clase que elimina un retiro de la base
		
		if(!$this->nuevo)
			return;
		
		if($this->id == 0)
			return;
		
		try{
			$sql = "DELETE FROM retiro WHERE id = :id";
			
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
	
	function getAgente(){
		return $this->agente;
	}
	
	function setAgente($agente){
		
		if($agente == null)
			return;
		
		if($this->agente != null && $this->agente->getId() == $agente->getId())
			return;
		
		$this->agente = Agente::agente($agente);
		$this->cambios = true;
	}
	
	function getElemento(){
		return $this->elemento;
	}
	
	function setElemento($elemento){
		
		if($elemento == null)
			return;
		
		if($this->elemento != null && $this->elemento->getId() == $elemento->getId())
			return;
		
		$this->elemento = Elemento::elemento($elemento);
		$this->cambios = true;
	}
	
	function getFecha(){
		return $this->fecha;
	}
	
	function setFecha($fecha){
		
		if($fecha == "")
			return;
		
		if($this->fecha == $fecha)
			return;
		
		$this->fecha = $fecha;
		$this->cambios = true;
	}
	
	function getCantidad(){
		return $this->cantidad;
	}
	
	function setCantidad($cantidad){
		
		if($cantidad == "")
			return;
		
		if($this->cantidad == $cantidad)
			return;
		
		$this->cantidad = $cantidad;
		$this->cambios = true;
	}
	
	function getComentario(){
		return $this->comentario;
	}
	
	function setComentario($comentario){
		
		if($this->comentario == $comentario)
			return;
		
		$this->comentario = $comentario;
		$this->cambios = true;
	}
}
