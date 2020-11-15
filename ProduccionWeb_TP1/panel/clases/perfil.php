<?php 
Class Perfil{

    /*OK*/
	private $con;
	/*OK*/
	public function __construct($con){
		$this->con = $con;
	}
	/*OK*/
	public function getList(){
		$query = "SELECT id, nombre 
					FROM perfil
					WHERE enabled = '1' ";
        return $this->con->query($query); 
	}
	/*OK*/
	public function get($id){
	    $query = "SELECT id,nombre
		        	FROM perfil WHERE id = ".$id;
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
		$query = "SELECT count(1) as cantidad FROM usuarios_perfiles WHERE perfil_id = ".$id." AND enabled = '1' ;";
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
		if($consulta->cantidad == 0){
			$query = "UPDATE perfil SET enabled = '0' WHERE id = ".$id.";"; 
			$this->con->exec($query); 
			$query = "UPDATE perfil_permisos SET enabled = '0' WHERE perfil_id = ".$id.";";
			$this->con->exec($query); 
			return 1;
		}
		return 'Perfil asignado a un usuario';
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
            $sql = "INSERT INTO perfil(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
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
            $sql = "UPDATE perfil SET ".implode(',',$columns)." WHERE id = ".$id;
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
}
