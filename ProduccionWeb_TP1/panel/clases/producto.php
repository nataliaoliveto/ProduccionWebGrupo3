<?php 
Class Producto{

    /*OK*/
	private $con;
	/*OK*/
	public function __construct($con){
		$this->con = $con;
	}
	/*OK*/
	public function getList($genID, $edadID){
		$query = "SELECT id, nombre, descripcion, precio, plataforma, genero, edad, estado
					FROM productos
					WHERE enabled = '1' AND (genero = $genID OR $genID = 0) AND (edad = $edadID OR $edadID = 0)";
        return $this->con->query($query); 
	}

	/*OK*/
	public function get($id){
		$query = "SELECT id,nombre
					FROM productos WHERE id = ".$id;
        $query = $this->con->query($query); 
			
		$perfil = $query->fetch(PDO::FETCH_OBJ);
			
			$sql = 'SELECT perfil_id, permiso_id
					FROM perfil_permisos  
					WHERE perfil_id = '.$perfil->id;
					
			foreach($this->con->query($sql) as $permiso){
				$perfil->permisos[] = $permiso['permiso_id'];
			}
			/*echo '<pre>';
			var_dump($perfil);echo '</pre>'; */
            return $perfil;
	}

	public function update($modif, $id){
		$act = ($modif -1) * -1;
		$this->con->exec("UPDATE productos SET estado = ".$act." WHERE id = ".$id);
	}

	public function getPermisos($id){
		$query = "	SELECT permisos.nombre
					FROM perfil INNER JOIN perfil_permisos
					ON perfil.id = perfil_permisos.perfil_id
					INNER JOIN permisos 
					ON permisos.id = perfil_permisos.permiso_id
					WHERE perfil.id=".$id." AND permisos.enabled = 1 ";
		return $this->con->query($query); 
	}

	public function getEdad($id){
		$query = "	SELECT edades.nombre
					FROM edades 
					WHERE edades.id=".$id." AND edades.enabled = 1 AND edades.estado = 1 ";
		/*
		$query = "	SELECT ".$tabla."nombre
					FROM ".$tabla." 
					WHERE ".$tabla.".id=".$id." AND ".$tabla.".enabled = 1 AND ".$tabla.".estado = 1 ";*/
		return $this->con->query($query); 
	}

	public function getGenero($id){
		$query = "	SELECT generos.nombre
					FROM generos 
					WHERE generos.id=".$id." AND generos.enabled = 1 AND generos.estado = 1 ";
		return $this->con->query($query); 
	}

	public function getPlataforma($id){
		$query = "	SELECT plataformas.nombre
					FROM plataformas 
					WHERE plataformas.id=".$id." AND plataformas.enabled = 1 AND plataformas.estado = 1 ";
		return $this->con->query($query); 
	}

	public function getGeneros(){
		$query = "SELECT * FROM generos WHERE estado = 1 AND generos.enabled = 1";
		return $this->con->query($query);
	}

	public function getGeneroEdades($genID){
		$query = "SELECT * FROM genero_edades WHERE idgen = $genID AND genero_edades.enabled = 1";
		return $this->con->query($query);
	}

	public function getEdadNombre($edadID){
		$query = "SELECT * FROM edades WHERE estado = 1 AND id = $edadID AND edades.enabled = 1";
		return $this->con->query($query);
	}



	public function del($id){
			$query = "UPDATE productos SET enabled = '0' WHERE id = ".$id.";"; 
			$this->con->exec($query);
	}
	
	/**
	* Guardo los datos en la base de datos
	*/
	public function save($data){
		
            foreach($data as $key => $value){
				
				if(!is_array($value)){
					if($value != null){
						$columns[]=$key;
						$datos[]=$value;
					}
				}
			}
			//var_dump($datos);die();
            $sql = "INSERT INTO productos(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
			//echo $sql;die();
			
            $this->con->exec($sql);
			$id = $this->con->lastInsertId();
			
			$sql = '';
			foreach($data['permisos'] as $permisos){
				$sql .= 'INSERT INTO perfil_permisos(perfil_id,permiso_id) 
							VALUES ('.$id.','.$permisos.');';
			}
			//echo $sql;die();
			$this->con->exec($sql);
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
            $sql = "UPDATE productos SET ".implode(',',$columns)." WHERE id = ".$id;
            //echo $sql; die();
            $this->con->exec($sql);
			
			$sql = 'DELETE FROM perfil_permisos WHERE perfil_id= '.$id;
			$this->con->exec($sql);
			
			$sql = '';
			foreach($data['permisos'] as $permisos){
				$sql .= 'INSERT INTO perfil_permisos(perfil_id,permiso_id) 
							VALUES ('.$id.','.$permisos.');';
			}
			$this->con->exec($sql);
			
	} 

	public function getPaginas($genID, $edadID){
		$query = "	SELECT 
					CASE
						WHEN COUNT(*)> 0 THEN 
							CASE
								WHEN MOD(COUNT(*),10) = 0 THEN COUNT(*) DIV 10
								ELSE (COUNT(*) DIV 10) + 1
							END

						ELSE 0
					END
					FROM productos 
					WHERE enabled = 1 AND (genero = $genID OR $genID = 0) AND (edad = $edadID OR $edadID = 0)";

		return $this->con->query($query)->fetchColumn(); 
	}
}
