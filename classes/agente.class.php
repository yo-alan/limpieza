<?php

require_once "conexion.class.php";

class Agente{
	
	private $nuevo;
	private $cambios;
	private $id;
	private $nombre;
	private $apellido;
	
	function __construct(){
		$this->nuevo = true;
		$this->cambios = true;
		$this->id = 0;
		$this->nombre = "";
		$this->apellido = "";
	}
	
	//INICIO METODOS ESTATICOS
	
	static function agente($id){
		//Metodo estatico que retorna un agente que posea el $id
		
		$a = new Agente();
		
		$conn = new Conexion();
		
		$sql = 'SELECT * FROM agente WHERE id = :id';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		$consulta->bindParam(':id', $id, PDO::PARAM_INT);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetch();
			
			$a->id = $results['id'];
			$a->nombre = $results['nombre'];
			$a->apellido = $results['apellido'];
			$a->nuevo = false;
			$a->cambios = false;
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo el agente: ". $ex->getMessage());
		}
		
		return $a;
	}
	
	static function agentes(){
		//METODO ESTATICO QUE RETORNA TODOS LOS AgenteS DE LA BASE
		
		$as = array();
		
		$conn = new Conexion();
		
		$sql = 'SELECT id FROM agente ORDER BY apellido, nombre';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetchall();
			
			foreach($results as $r){
				
				$a = Agente::agente($r['id']);
				
				array_push($as, $a);
			}
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo los agentes: ". $ex->getMessage());
		}
		
		return $as;
	}
	
	//INICIO METODOS DE CLASE
	
	function guardar(){
		//Metodo de clase que guarda un agente en la base
		
		if(!$this->cambios)//Si no hay cambios en el objeto
			return;
		
		if($this->nombre == "")
			throw new Exception("El nombre no es válido.");
		
		if($this->apellido == "")
			throw new Exception("El apellido no es válido.");
		
		$conn = new Conexion();
		
		if($this->nuevo){//Si el objeto es nuevo se hace un INSERT
			
			try{
				$sql = "INSERT INTO agente(nombre, apellido) VALUES(:nombre, :apellido)";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
				$stmt->bindParam(':apellido', $this->apellido, PDO::PARAM_STR);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				
				throw new Exception("No me pude guardar como agente: ". $ex->getMessage());
			}
			
		}
		else{//Si el objeto no es nuevo se hace un UPDATE
			
			try{
				$sql = "UPDATE agente SET nombre = :nombre, apellido = :apellido
						WHERE id = :id";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
				$stmt->bindParam(':apellido', $this->apellido, PDO::PARAM_STR);
				$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				
				throw new Exception("Ocurrió un error mientras me actualizaba: ". $ex->getMessage());
			}
		}
	}
	
	function eliminar(){
		//Metodo de clase que elimina un agente de la base
		
		if(!$this->nuevo)
			return;
		
		if($this->id == 0)
			return;
		
		try{
			$sql = "DELETE FROM agente WHERE id = :id";
			
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
	
	function getNombre(){
		return $this->nombre;
	}
	
	function setNombre($nombre){
		
		if($nombre == "")
			throw new Exception("El nombre contiene caracteres no permitidos.");
		
		if(count(explode(' ', $nombre)) > 1){
			
			$nombres = explode(' ', $nombre);
			
			if(in_array("", $nombres))
				unset($nombres[sizeof($nombres)-1]);
			
			foreach($nombres as $n){
				
				if(!ctype_alpha($n))
					throw new Exception("El nombre contiene caracteres no permitidos.");
				
			}
		}
		else if(!ctype_alpha($nombre))
			throw new Exception("El nombre contiene caracteres no permitidos.");
		
		if($this->nombre == ucfirst($nombre))
			return;
		
		$this->nombre = ucfirst($nombre);
		$this->cambios = true;
	}
	
	function getApellido(){
		return $this->apellido;
	}
	
	function setApellido($apellido){
		
		if($apellido == "")
			throw new Exception("El apellido no puede estar vacío.");
		
		if(count(explode(' ', $apellido)) > 1){
			
			$apellidos = explode(' ', $apellido);
			
			if(in_array("", $apellidos))
				unset($apellidos[sizeof($apellidos)-1]);
			
			foreach($apellidos as $a){
				
				if(!ctype_alpha($a))
					throw new Exception("El apellido contiene caracteres no permitidos.");
				
			}
		}
		else if(!ctype_alpha($apellido))
			throw new Exception("El apellido contiene caracteres no permitidos.");
		
		if($this->apellido == ucfirst($apellido))
			return;
		
		$this->apellido = ucfirst($apellido);
		$this->cambios = true;
	}
}
