<?php

require_once "conexion.class.php";
require_once "elemento.class.php";

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
		$this->elemento = null;
		$this->cantidad = 0;
		$this->fecha = "";
		$this->expediente = "";
		$this->comentario = "";
	}
	
	//INICIO METODOS ESTATICOS
	
	static function ingreso($id){
		//Metodo estatico que retorna un ingreso que posea el $id
		
		$i = new Ingreso();
		
		$conn = new Conexion();
		
		$sql = 'SELECT * FROM ingreso WHERE id = :id';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		$consulta->bindParam(':id', $id, PDO::PARAM_INT);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetch();
			
			$i->id = $results['id'];
			$i->elemento = Elemento::elemento($results['elemento']);
			$i->cantidad = $results['cantidad'];
			$i->fecha = $results['fecha'];
			$i->expediente = $results['expediente'];
			$i->comentario = $results['comentario'];
			$i->nuevo = false;
			$i->cambios = false;
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo el ingreso: ". $ex->getMessage());
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
			throw new Exception("Ocurrió un error obteniendo los ingresos: ". $ex->getMessage());
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
				
				$stmt->bindParam(':elemento', $this->elemento->getNombre(), PDO::PARAM_STR);
				$stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
				$stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
				$stmt->bindParam(':expediente', $this->expediente, PDO::PARAM_STR);
				$stmt->bindParam(':comentario', $this->comentario, PDO::PARAM_STR);
				
				$stmt->execute();
				
				$e = Elemento::elemento($this->elemento->getNombre());
				
				$e->setStock($e->getStock() + $this->cantidad);
				
				$e->guardar();
				
			} catch(PDOException $ex){
				
				throw new Exception("No me pude guardar como ingreso: ". $ex->getMessage());
			}
			
		}
		else{//Si el objeto no es nuevo se hace un UPDATE
			
			try{
				
				$sql = "UPDATE elemento
						INNER JOIN ingreso ON ingreso.id = :id AND ingreso.elemento = elemento.nombre
						SET elemento.stock = elemento.stock - ingreso.cantidad";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
				
				$stmt->execute();
				
				$sql = "UPDATE ingreso SET elemento = :elemento, cantidad = :cantidad, fecha = :fecha, expediente = :expediente, comentario = :comentario
						WHERE id = :id";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':elemento', $this->elemento->getNombre(), PDO::PARAM_STR);
				$stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
				$stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
				$stmt->bindParam(':expediente', $this->expediente, PDO::PARAM_STR);
				$stmt->bindParam(':comentario', $this->comentario, PDO::PARAM_STR);
				$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
				
				$this->elemento = Elemento::elemento($this->elemento->getNombre());
				
				$this->elemento->setStock($this->elemento->getStock() + $this->cantidad);
				
				$this->elemento->guardar();
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				
				throw new Exception("Ocurrió un error mientras me actualizaba: ". $ex->getMessage());
			}
		}
	}
	
	function eliminar(){
		//Metodo de clase que elimina un ingreso de la base
		
		if($this->nuevo)
			return;
		
		if($this->id == 0)
			return;
		
		$conn = new Conexion();
		
		try{
			
			$sql = "UPDATE elemento
					INNER JOIN ingreso ON ingreso.id = :id AND ingreso.elemento = elemento.nombre
					SET elemento.stock = elemento.stock - ingreso.cantidad";
			
			$stmt = $conn->prepare($sql);
			
			$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
			
			$stmt->execute();
			
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
		
		if($this->elemento != null && $this->elemento->getNombre() == $elemento)
			return;
		
		$this->elemento = Elemento::elemento($elemento);
		$this->cambios = true;
	}
	
	function getCantidad(){
		return $this->cantidad;
	}
	
	function setCantidad($cantidad){
		
		if($cantidad <= 0)
			return;
		
		if($this->cantidad == $cantidad)
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
		
		$hoy = getDate();
		
		$hoy = $hoy["year"]. "-". $hoy["mon"]. "-". $hoy["mday"];
		
		if(strtotime($fecha) > strtotime($hoy))
			throw new Exception("La fecha no es válida: No se puede expecificar una fecha futura.");
		
		if($this->fecha == $fecha)
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
		
		if($this->expediente == $expediente)
			return;
		
		$this->expediente = $expediente;
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
