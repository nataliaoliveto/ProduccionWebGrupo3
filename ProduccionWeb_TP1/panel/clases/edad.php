<?php 
Class Edad{

	private $con;
	
	public function __construct($con){
		$this->con = $con;
	}

	public function getList(){
		$query = "SELECT * 
					FROM edades
					WHERE enabled = '1' ";
        return $this->con->query($query); 
	}

	public function getCategoria($id){
		$query = "	SELECT generos.nombre
					FROM generos INNER JOIN genero_edades
					ON generos.id = genero_edades.idgen
					INNER JOIN edades 
					ON edades.id = genero_edades.idedad
					WHERE edades.id=".$id." AND generos.enabled = 1 AND generos.estado = 1 ";
		return $this->con->query($query); 
	}

	public function get($id){
		$query = "SELECT id, nombre
				FROM edades WHERE id = ".$id;
        $query = $this->con->query($query); 
			
		$perfil = $query->fetch(PDO::FETCH_OBJ);
			
			$sql = 'SELECT idedad, idgen
					FROM genero_edades  
					WHERE idedad = '.$perfil->id;
					
			foreach($this->con->query($sql) as $permiso){
				$perfil->permisos[] = $permiso['idedad'];
			}
			/*echo '<pre>';
			var_dump($perfil);echo '</pre>'; */
            return $perfil;
	}

	public function getGeneros(){
		$query = 'SELECT * FROM generos WHERE enabled = 1';
    	return  $this->con->query($query);
	}

	public function del($id){
		$query = "SELECT count(1) as cantidad FROM genero_edades INNER JOIN productos ON genero_edades.idedad = productos.edad WHERE idedad = ".$id." AND genero_edades.enabled = 1 AND productos.enabled = 1";
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
		if($consulta->cantidad == 0){
			$query = "UPDATE edades  SET enabled = 0, estado = 0 WHERE id = ".$id; 
			$this->con->exec($query);
			
			$query = "DELETE FROM genero_edades WHERE idedad = ".$id;
			$this->con->exec($query);

			return 1;
		}
		return 'Edad asignada a un género y/o producto';
	}

	public function selGen($id){
		$query = "SELECT idgen
					FROM genero_edades
					WHERE idedad =".$id;
		$query = $this->con->query($query);
		return $query;
	}

	public function update($modif, $id){
		$act = ($modif -1) * -1;
		$this->con->exec("UPDATE edades SET estado = ".$act." WHERE id = ".$id);
	}
	
	public function save($data){
		$query = "SELECT COUNT(*) FROM edades WHERE UPPER(nombre) = UPPER('".$data['nombre']."')";
		$consulta = $this->con->query($query)->fetchColumn();  

		if($consulta == 0){
			$query = "INSERT INTO edades (nombre) VALUES('".$data['nombre']."')";
			$this->con->exec($query); 
		} 
		return $consulta;
	} 

	public function edit($data){
		$id = $data['id'];
		unset($data['id']);

		foreach($data as $key => $value){
			if(!is_array($value)){
				if($value != null){	
					$columns[]=$key." = '".$value."'"; 
				}
			}
		}
		$sql = "UPDATE edades SET ".implode(',',$columns)." WHERE id = ".$id;
		//echo $sql; die();
		$this->con->exec($sql);
				
		$sql = 'DELETE FROM genero_edades WHERE idedad= '.$id;
		$this->con->exec($sql); 
		
		$sql = '';
		foreach($data['generos'] as $generos){
			$sql .= 'INSERT INTO genero_edades(idedad,idgen) 
						VALUES ('.$id.','.$generos.');';
		}
		$this->con->exec($sql);
}
	
}
