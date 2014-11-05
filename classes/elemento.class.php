<?php

include "conexion.class.php";

class Elemento{
	
	private $nuevo;
	private $cambios;
	private $id;
	private $nombre;
	
	function __construct(){
		$this->nuevo = true;
		$this->cambios = true;
		$this->id = 0;
		$this->nombre = "";
	}
	
	//INICIO METODOS ESTATICOS
	
	static function elemento($legajo){
		//Metodo estatico que retorna un elemento que posea el $legajo
		
		$a = new Elemento();
		
		$conn = new Conexion();
		
		$sql = 'SELECT nombre, apellido, p.documento, f_nacimiento, legajo, direccion
				FROM persona p, elemento a
				WHERE a.documento = p.documento AND legajo = :legajo';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		$consulta->bindParam(':legajo', $legajo, PDO::PARAM_INT);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetch();
			
			$a->nombre = $results['nombre'];
			$a->apellido = $results['apellido'];
			$a->documento = $results['documento'];
			$a->f_nacimiento = $results['f_nacimiento'];
			$a->legajo = $results['legajo'];
			$a->direccion = $results['direccion'];
			$a->nuevo = false;
			$a->cambios = false;
			
		}catch(PDOException $e){
			
		}
		
		return $a;
	}
	
	static function elementos(){
		//MMETODO ESTATICO QUE RETORNA TODOS LOS elementoS DE LA BASE
		
		$as = array();
		
		$conn = new Conexion();
		
		$sql = 'SELECT legajo FROM elemento';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetchall();
			
			foreach($results as $r){
				
				$a = Elemento::elemento($r['legajo']);
				
				array_push($as, $a);
			}
			
		}catch(PDOException $e){
			
		}
		
		return $as;
	}
	
	//INICIO METODOS DE CLASE
	
	function guardar(){
		//Metodo de clase que guarda un elemento en la base
		
		if(!$this->cambios)//Si no hay cambios en el objeto
			return;
		
		if($this->nombre == "")
			throw new Exception("El nombre no es válido.");
		
		if($this->apellido == "")
			throw new Exception("El apellido no es válido.");
		
		if($this->documento == 0)
			throw new Exception("El documento no es válido.");
		
		if($this->direccion == "")
			throw new Exception("La dirección no es válida.");
		
		if($this->legajo == "")
			throw new Exception("El número de legajo no es válido.");
		
		$conn = new Conexion();
		
		if($this->nuevo){//Si el objeto es nuevo se hace un INSERT
			
			try{
				$sql = "INSERT INTO persona(nombre, apellido, documento, f_nacimiento, direccion)
						VALUES(:nombre, :apellido, :documento, :f_nacimiento, :direccion)";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
				$stmt->bindParam(':apellido', $this->apellido, PDO::PARAM_STR);
				$stmt->bindParam(':documento', $this->documento, PDO::PARAM_INT);
				$stmt->bindParam(':f_nacimiento', $this->f_nacimiento, PDO::PARAM_STR);
				$stmt->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);
				
				$stmt->execute();
				
			} catch(PDOException $e){
				throw new Exception("No me pude guardar como persona: ". $e->getMessage());
			}
			
			try{
				$sql = "INSERT INTO elemento(documento, legajo)
						VALUES(:documento, :legajo)";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':documento', $this->documento, PDO::PARAM_INT);
				$stmt->bindParam(':legajo', $this->legajo, PDO::PARAM_STR);
				
				$stmt->execute();
				
			} catch(PDOException $e){
				throw new Exception("No me pude guardar como elemento: ". $e->getMessage());
			}
			
		}
		else{//Si el objeto no es nuevo se hace un UPDATE
			
			
			
			
		}
		
	}
	
	function eliminar(){
		//Metodo de clase que elimina un elemento de la base
		
		if(!$this->nuevo)
			return;
		
		if($this->id == 0)
			return;
		
		try{
			$sql = "DELETE FROM elemento WHERE id = :id";
			
			$stmt = $conn->prepare($sql);
			
			$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
			
			$stmt->execute();
			
		} catch(PDOException $e){
			throw new Exception("No pude eliminarme de la base: ". $e->getMessage());
		}
		
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
	
}
