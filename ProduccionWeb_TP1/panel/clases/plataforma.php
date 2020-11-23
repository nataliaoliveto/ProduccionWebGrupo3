<?php 
Class Plataforma{

    /*conexion a la base*/
	private $con;
	
	public function __construct($con){
		$this->con = $con;
	}

	public function getList(){
		$query = "SELECT * 
					FROM plataformas
					WHERE enabled = '1' ";
        return $this->con->query($query); 
	}
	
	public function get($id){
		$query = "SELECT id, nombre
				FROM plataformas WHERE id = ".$id;
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

	public function del($id){
		$query = "SELECT count(1) as cantidad FROM productos WHERE plataforma = ".$id." AND enabled = '1' ;";
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
		if($consulta->cantidad == 0){
			$query = "UPDATE plataformas SET enabled = 0, estado = 0 WHERE id = ".$id; 
			$this->con->exec($query); 
			return 1;
		}
		return 'Plataforma asignada a un juego';
	}

	public function update($modif, $id){
		$act = ($modif -1) * -1;
		$this->con->exec("UPDATE plataformas SET estado = ".$act." WHERE id = ".$id);
	}
	
	public function save($data){
		$query = "SELECT COUNT(*) FROM plataformas WHERE enabled = 1 AND UPPER(nombre) = UPPER('".$data['nombre']."')";
		$consulta = $this->con->query($query)->fetchColumn();  

		if($consulta == 0){
			$query = "INSERT INTO plataformas (nombre) VALUES('".$data['nombre']."')";
			$this->con->exec($query); 
		} 
		return $consulta;
	} 

	public function edit($data){
			$id = $data['id'];
			unset($data['id']);
            
			$this->con->exec("UPDATE plataformas SET nombre = '".$data['nombre']."' WHERE id = ".$id);
	}
	
}
