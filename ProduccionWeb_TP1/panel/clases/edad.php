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
            
			$this->con->exec("UPDATE edades SET nombre = '".$data['nombre']."' WHERE id = ".$id);
	}
	
}
