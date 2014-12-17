<?php

require_once "conexion.class.php";

class Elemento{
	
	private $nuevo;
	private $cambios;
	private $id;
	private $nombre;
	private $unidad;
	private $stock;
	
	function __construct(){
		$this->nuevo = true;
		$this->cambios = true;
		$this->id = 0;
		$this->nombre = "";
		$this->unidad = "";
		$this->stock = 0;
	}
	
	//INICIO METODOS ESTATICOS
	
	static function elemento($nombre){
		//Metodo estatico que retorna un elemento que posea el $legajo
		
		$e = new Elemento();
		
		$conn = new Conexion();
		
		$sql = 'SELECT * FROM elemento WHERE nombre = :nombre';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		$consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetch();
			
			$e->id = $results['id'];
			$e->nombre = $results['nombre'];
			$e->unidad = $results['unidad'];
			$e->stock = $results['stock'];
			$e->nuevo = false;
			$e->cambios = false;
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo el elemento: ". $ex->getMessage());
		}
		
		return $e;
	}
	
	static function elementos(){
		//METODO ESTATICO QUE RETORNA TODOS LOS elementoS DE LA BASE
		
		$es = array();
		
		$conn = new Conexion();
		
		$sql = 'SELECT nombre FROM elemento ORDER BY nombre';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetchall();
			
			foreach($results as $r){
				
				$e = Elemento::elemento($r['nombre']);
				
				array_push($es, $e);
			}
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo los elementos: ". $ex->getMessage());
		}
		
		return $es;
	}
	
	//INICIO METODOS DE CLASE
	
	function guardar(){
		//Metodo de clase que guarda un elemento en la base
		
		if(!$this->cambios)//Si no hay cambios en el objeto
			return;
		
		if($this->nombre == "")
			throw new Exception("El nombre no es válido.");
		
		if($this->unidad == "")
			throw new Exception("La unidad de medida no es válida.");
		
		if($this->stock < 0)
			throw new Exception("El stock no es válido.");
		
		$conn = new Conexion();
		
		if($this->nuevo){//Si el objeto es nuevo se hace un INSERT
			
			try{
				$sql = "INSERT INTO elemento(nombre, unidad, stock)
						VALUES(:nombre, :unidad, :stock)";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
				$stmt->bindParam(':unidad', $this->unidad, PDO::PARAM_STR);
				$stmt->bindParam(':stock', $this->stock, PDO::PARAM_INT);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				
				throw new Exception("No me pude guardar como elemento: ". $ex->getMessage());
			}
			
		}
		else{//Si el objeto no es nuevo se hace un UPDATE
			
			try{
				$sql = "UPDATE elemento SET nombre = :nombre, unidad = :unidad, stock = :stock
						WHERE id = :id";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
				$stmt->bindParam(':unidad', $this->unidad, PDO::PARAM_STR);
				$stmt->bindParam(':stock', $this->stock, PDO::PARAM_INT);
				$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				
				throw new Exception("Ocurrió un error mientras me actualizaba: ". $ex->getMessage());
			}
			
		}
		
	}
	
	function eliminar(){
		//Metodo de clase que elimina un elemento de la base
		
		if($this->nuevo)
			return;
		
		if($this->id == 0)
			return;
		
		$conn = new Conexion();
		
		try{
			$sql = "DELETE FROM elemento WHERE id = :id";
			
			$stmt = $conn->prepare($sql);
			
			$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
			
			$stmt->execute();
			
		} catch(PDOException $ex){
			throw new Exception("No pude eliminarme de la base: ". $ex->getMessage());
		}
		
	}
	
	function imprimir(){
		
		$t = array();
		
		$conn = new Conexion();
		
		$conn->exec("set names latin1");
		
		$sql = 'SELECT nombre, unidad, stock FROM elemento ORDER BY nombre';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetchall();
			
			foreach($results as $r){
				$t[] = array($r['nombre'], $r['unidad'], $r['stock']);
			}
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo los elementos: ". $ex->getMessage());
		}
		
		return $t;
	}
	
	//INICIO METODOS GETTERS Y SETTERS
	
	function getId(){
		return $this->id;
	}
	
	function getNombre(){
		return $this->nombre;
	}
	
	function setNombre($nombre){
		
		if($nombre == "")
			return;
		
		$this->nombre = $nombre;
		$this->cambios = true;
	}
	
	function getUnidad(){
		return $this->unidad;
	}
	
	function setUnidad($unidad){
		
		$unidades = array('Kilos', 'Litros', 'Rollos', 'Unitario');
		
		if(!in_array($unidad, $unidades))
			return;
		
		$this->unidad = $unidad;
		$this->cambios = true;
	}
	
	function getStock(){
		return $this->stock;
	}
	
	function setStock($stock){
		
		if($stock < 0)
			throw new Exception("El stock no puede ser negativo.");
			
		$this->stock = $stock;
		$this->cambios = true;
	}
	
}
