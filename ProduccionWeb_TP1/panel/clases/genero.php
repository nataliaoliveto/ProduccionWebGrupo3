<?php 
Class Genero{

    /*conexion a la base*/
	private $con;
	
	/*ok*/
	public function __construct($con){
		$this->con = $con;
	}
	/*ok*/
	public function getList(){
		$query = "SELECT * 
					FROM generos
					WHERE enabled = '1' ";
        return $this->con->query($query); 
	}
	
	/*nuevo*/
	public function getSubcategoria($id){
		$query = "	SELECT edades.nombre
					FROM generos INNER JOIN genero_edades
					ON generos.id = genero_edades.idgen
					INNER JOIN edades 
					ON edades.id = genero_edades.idedad
					WHERE generos.id=".$id." AND edades.enabled = 1 AND edades.estado = 1 ";
		return $this->con->query($query); 
	}

	public function get($id){
		$query = "SELECT id, nombre
				FROM generos WHERE id = ".$id;
        $query = $this->con->query($query); 
			
		$perfil = $query->fetch(PDO::FETCH_OBJ);
			
			$sql = 'SELECT idedad, idgen
					FROM genero_edades  
					WHERE idgen = '.$perfil->id;
					
			foreach($this->con->query($sql) as $permiso){
				$perfil->permisos[] = $permiso['idgen'];
			}
			/*echo '<pre>';
			var_dump($perfil);echo '</pre>'; */
            return $perfil;
	}

	public function selEdad($id){
		$query = "SELECT idedad
					FROM genero_edades
					WHERE idgen =".$id;
		$query = $this->con->query($query);
		return $query;
	}

	public function update($modif, $id){
		$act = ($modif -1) * -1;
		$this->con->exec("UPDATE generos SET estado = ".$act." WHERE id = ".$id);
	}
	
	public function del($id){
		$query = "SELECT count(1) as cantidad FROM genero_edades INNER JOIN productos ON genero_edades.idgen = productos.genero WHERE idgen = ".$id." AND genero_edades.enabled = 1 AND productos.enabled = 1";
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
		if($consulta->cantidad == 0){
			$query = "UPDATE generos SET enabled = 0, estado = 0 WHERE id = ".$id; 
			$this->con->exec($query); 
			return 1;
		}
		return 'Género relacionado con una edad y/o producto';
	}
	
	public function save($data){
		$query = "SELECT COUNT(*) FROM generos WHERE UPPER(nombre) = UPPER('".$data['nombre']."')";
		$consulta = $this->con->query($query)->fetchColumn();  

		if($consulta == 0){
			$query = "INSERT INTO generos (nombre) VALUES('".$data['nombre']."')";
			$this->con->exec($query); 
		} 
		return $consulta;
	} 

	public function edit($data){
			$id = $data['id'];
			unset($data['id']);
			//$this->con->exec("UPDATE generos SET nombre = '".$data['nombre']."' WHERE id = ".$id);

			foreach($data as $key => $value){
				if(!is_array($value)){
					if($value != null){	
						$columns[]=$key." = '".$value."'"; 
					}
				}
			}
			$sql = "UPDATE generos SET ".implode(',',$columns)." WHERE id = ".$id;
			//echo $sql; die();
			$this->con->exec($sql);
					
			$sql = 'DELETE FROM genero_edades WHERE idgen= '.$id;
			$this->con->exec($sql); 
			
			$sql = '';
			foreach($data['edades'] as $edades){
				$sql .= 'INSERT INTO genero_edades(idgen,idedad) 
							VALUES ('.$id.','.$edades.');';
			}
			$this->con->exec($sql);
	}

}
