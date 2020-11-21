<?php 
Class Comentario{

	private $con;
	
	public function __construct($con){
		$this->con = $con;
	}

	public function getList($estado, $pag, $idprod){
		$desde = ($pag - 1) * 10;
		$hasta = $desde + 10;
		
		$query = " 	SELECT productos.nombre, comentarios.id, comentarios.descripcion, comentarios.calificacion, comentarios.fecha, comentarios.estado
					FROM comentarios 
					INNER JOIN productos 
					ON comentarios.IDproducto = productos.id
					WHERE comentarios.enabled = 1 AND (comentarios.estado = " .$estado. " OR " .$estado. " = 2) AND (comentarios.IDproducto = " .$idprod. " OR " .$idprod. " = 0)
					LIMIT $desde, $hasta";

        return $this->con->query($query); 
	}
	
	public function get($id){
		$query = "	SELECT id
					FROM comentarios WHERE id = ".$id;
        $query = $this->con->query($query); 
			
		$comentario = $query->fetch(PDO::FETCH_OBJ);
			
			$sql = 'SELECT perfil_id, permiso_id
					FROM perfil_permisos  
					WHERE perfil_id = '.$comentario->id;
					
			foreach($this->con->query($sql) as $permiso){
				$comentario->permisos[] = $permiso['permiso_id'];
			}
			/*echo '<pre>';
			var_dump($comentario);echo '</pre>'; */
            return $comentario;
	}

	public function update($modif, $id){
		$act = ($modif -1) * -1;
		$this->con->exec("UPDATE comentarios SET estado = ".$act." WHERE id = ".$id);
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

	public function getPaginas($estado){
		$query = "	SELECT 
					CASE
						WHEN COUNT(*)> 0 THEN 
							CASE
								WHEN MOD(COUNT(*),10) = 0 THEN COUNT(*) DIV 10
								ELSE (COUNT(*) DIV 10) + 1
							END

						ELSE 0
					END
					FROM comentarios 
					WHERE comentarios.enabled = 1 AND (comentarios.estado = " .$estado. " or " .$estado. " = 2)";

		return $this->con->query($query)->fetchColumn(); 
	}
}