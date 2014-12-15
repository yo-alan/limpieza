<?php

require_once "conexion.class.php";

class Usuario{
	
	private $nuevo;
	private $cambios;
	private $id;
	private $nombre;
	private $contrasena;
	private $nivel;
	
	function __construct(){
		$this->nuevo = true;
		$this->cambios = true;
		$this->id = 0;
		$this->nombre = "";
		$this->contrasena = "";
		$this->nivel = "";
	}
	
	//INICIO METODOS ESTATICOS
	
	static function usuario($id=0, $nombre="", $contrasena=""){
		//Metodo estatico que retorna un usuario que posea el $id
		
		$u = new Usuario();
		
		$conn = new Conexion();
		
		if($id != 0)
			$sql = "SELECT * FROM usuario WHERE id = :id";
		else
			$sql = "SELECT * FROM usuario WHERE nombre = :nombre AND contrasena = PASSWORD(:contrasena)";
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		if($id != 0)
			$consulta->bindParam(':id', $id, PDO::PARAM_INT);
		else{
			$consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
			$consulta->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
		}
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetch();
			
			$u->id = $results['id'];
			$u->nombre = $results['nombre'];
			$u->contrasena = $results['contrasena'];
			$u->nivel = $results['nivel'];
			$u->nuevo = false;
			$u->cambios = false;
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo el usuario: ". $ex->getMessage());
		}
		
		return $u;
	}
	
	static function usuarios(){
		//METODO ESTATICO QUE RETORNA TODOS LOS usuarioS DE LA BASE
		
		$us = array();
		
		$conn = new Conexion();
		
		$sql = 'SELECT id FROM usuario ORDER BY nombre';
		
		$consulta = $conn->prepare($sql);
		
		$consulta->setFetchMode(PDO::FETCH_ASSOC);
		
		try{
			
			$consulta->execute();
			
			$results = $consulta->fetchall();
			
			foreach($results as $r){
				
				$u = Usuario::usuario($id=$r['id']);
				
				array_push($us, $u);
			}
			
		}catch(PDOException $ex){
			throw new Exception("Ocurrió un error obteniendo los usuarios: ". $ex->getMessage());
		}
		
		return $us;
	}
	
	//INICIO METODOS DE CLASE
	
	function guardar(){
		//Metodo de clase que guarda un usuario en la base
		
		if(!$this->cambios)//Si no hay cambios en el objeto
			return;
		
		if($this->nombre == "")
			throw new Exception("El nombre no es válido.");
		
		if($this->contrasena == "")
			throw new Exception("La contraseña no es válida.");
		
		if($this->nivel == "")
			throw new Exception("El nivel no es válido.");
		
		$conn = new Conexion();
		
		if($this->nuevo){//Si el objeto es nuevo se hace un INSERT
			
			try{
				$sql = "INSERT INTO usuario(nombre, contrasena, nivel) VALUES(:nombre, PASSWORD(:contrasena), :nivel)";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
				$stmt->bindParam(':contrasena', $this->contrasena, PDO::PARAM_STR);
				$stmt->bindParam(':nivel', $this->nivel, PDO::PARAM_STR);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				
				throw new Exception("No me pude guardar como usuario: ". $ex->getMessage());
			}
			
		}
		else{//Si el objeto no es nuevo se hace un UPDATE
			
			try{
				$sql = "UPDATE usuario SET nombre = :nombre, contrasena = PASSWORD(:contrasena), nivel = :nivel
						WHERE id = :id";
				
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
				$stmt->bindParam(':contrasena', $this->contrasena, PDO::PARAM_STR);
				$stmt->bindParam(':nivel', $this->nivel, PDO::PARAM_STR);
				$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
				
				$stmt->execute();
				
			} catch(PDOException $ex){
				throw new Exception("Ocurrió un error mientras me actualizaba: ". $ex->getMessage());
			}
		}
	}
	
	function eliminar(){
		//Metodo de clase que elimina un usuario de la base
		
		if($this->nuevo)
			return;
		
		if($this->id == 0)
			return;
		
		$conn = new Conexion();
		
		try{
			$sql = "DELETE FROM usuario WHERE id = :id";
			
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
		
		if(strlen($nombre) < 6)
			throw new Exception("El nombre tiene que tener más de 6 caracteres.");
		
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
		
		if($this->nombre == $nombre)
			return;
		
		$this->nombre = $nombre;
		$this->cambios = true;
	}
	
	function getContrasena(){
		return $this->contrasena;
	}
	
	function setContrasena($contrasena){
		
		if($contrasena == "")
			throw new Exception("La contraseña no puede estar vacía.");
		
		if($this->contrasena == $contrasena)
			return;
		
		$this->contrasena = $contrasena;
		$this->cambios = true;
	}
	
	function getNivel(){
		return $this->nivel;
	}
	
	function setNivel($nivel){
		
		if($nivel == "")
			throw new Exception("El nivel no puede estar vacío.");
		
		$nivel = ucfirst($nivel);
		
		if(!in_array($nivel, array('Administrador', 'Normal')))
			throw new Exception("El nivel no es válido.");
		
		if($this->nivel == $nivel)
			return;
		
		$this->nivel = $nivel;
		$this->cambios = true;
	}
}
