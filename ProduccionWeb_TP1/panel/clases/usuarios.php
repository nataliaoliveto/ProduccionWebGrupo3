<?php 
Class Usuario{

    /*conexion a la base*/
	private $con;
	
	
	public function __construct($con){
		$this->con = $con;
	}
        /**
        * Obtengo todos los usuarios
        */
	public function getList(){
		$query = "SELECT id_usuario,nombre,apellido,email,usuario,clave,activo 
		           FROM usuarios ";
		$resultado = array();
		foreach($this->con->query($query) as $key=>$usuario){
			$resultado[$key] = $usuario;
			$sql = 'SELECT nombre 
					  FROM perfil 
					  INNER JOIN usuarios_perfiles ON (usuarios_perfiles.perfil_id = perfil.id)
					  WHERE usuarios_perfiles.usuario_id = '.$usuario['id_usuario'];
			foreach($this->con->query($sql) as $perfil){
				$resultado[$key]['perfiles'][] = $perfil['nombre'];
			}
			
			
		}
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado; 
	}
	
	/**
	* obtengo un usuario
	*/
	public function get($id){
	    $query = "SELECT id_usuario,nombre,apellido,email,usuario,clave,activo,salt
		           FROM usuarios WHERE id_usuario = ".$id;
        $query = $this->con->query($query); 
			
		$usuario = $query->fetch(PDO::FETCH_OBJ);
			
			$sql = 'SELECT perfil_id
					  FROM usuarios_perfiles  
					  WHERE usuarios_perfiles.usuario_id = '.$usuario->id_usuario;
					  
			foreach($this->con->query($sql) as $perfil){
				$usuario->perfiles[] = $perfil['perfil_id'];
			}
			/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $usuario;
	}
	
	
	/**
	* Guardo los datos en la base de datos
	*/
	public function save($data){
			$data['salt'] = uniqid();
            // $data['salt'] = md5(date("Y-m-d H:i:s"));
            $data['clave'] = $this->encrypt($data['clave'],$data['salt']);
            
            foreach($data as $key => $value){
				if(!is_array($value)){
					if($value != null){
						$columns[]=$key;
						$datos[]=$value;
					}
				}
            }
            $sql = "INSERT INTO usuarios(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
            $this->con->exec($sql);
			$id_usuario = $this->con->lastInsertId();
			  			
			$sql = '';
			foreach($data['perfil'] as $perfil){
				$sql .= 'INSERT INTO usuarios_perfiles(usuario_id,perfil_id) 
							VALUES ('.$id_usuario.','.$perfil.');';
			}
 			$this->con->exec($sql);
	} 
	
	/**
	* Actualizo los datos en la base de datos
	*/
	public function edit($data){
	    $id = $data['id_usuario'];
	    unset($data['id_usuario']);
	    
            if( $data['clave'] != null){
				$user = $this->get($id);
                $data['clave'] = $this->encrypt($data['clave'],$user->salt);
            }else{
                unset($data['clave']);
			}
			
            foreach($data as $key => $value){
                if($value != null){
                    $columns[]=$key." = '".$value."'"; 
                }
            }
            $sql = "UPDATE usuarios SET ".implode(',',$columns)." WHERE id_usuario = ".$id;
            
            $this->con->exec($sql);
			
			 
			 
			$sql = 'DELETE FROM usuarios_perfiles WHERE usuario_id = '.$id;
			$this->con->exec($sql);
			
			$sql = '';
			foreach($data['perfil'] as $perfil){
				$sql .= 'INSERT INTO usuarios_perfiles(usuario_id,perfil_id) 
							VALUES ('.$id.','.$perfil.');';
			}
 			$this->con->exec($sql);
	} 
	
	/**
	* encrypt password
	*/
	
	private function encrypt($clave,$salt){
		
		/* concateno el salt con la clave */
		$clave .= $salt;
		
		/* pongo el salt al medio de la contraseña */
		//$clave = substr($clave,0,strlen($clave)/2).$salt.substr($clave,strlen($clave)/2,strlen($clave));
		
		/* par aobtener la lista de algoritmos de hash usar hash_algos()*/
		//return md5($clave);
		return hash('md5',$clave);
	}
	/**
	* borrado de usuario
	*/
	
        public function del($id){
			$sql = "DELETE FROM usuarios WHERE id_usuario = ".$id.';';
			$sql .= 'DELETE FROM usuarios_perfiles WHERE usuario_id = '.$id;

            $this->con->exec($sql);
        }
		
	
	/**
	* Login de usuario
	*/
	
        public function login($data){
            $sql = "SELECT id_usuario,nombre,apellido,email,usuario,clave,activo,salt
		           FROM usuarios WHERE activo = 1 AND usuario = '".$data['usuario']."'";
			$datos = $this->con->query($sql)->fetch(PDO::FETCH_ASSOC);
 			if(isset($datos['id_usuario'])){
				if($this->encrypt($data['clave'],$datos['salt']) == $datos['clave']){
				
					$_SESSION['usuario'] = $datos;
					$query = "SELECT DISTINCT cod, seccion FROM permisos
							  INNER JOIN perfil_permisos ON (perfil_permisos.permiso_id = permisos.id)
							  INNER JOIN usuarios_perfiles ON (usuarios_perfiles.perfil_id = perfil_permisos.perfil_id)
							  WHERE usuario_id = ".$datos['id_usuario'];
					$permisos = array(); 
					foreach($this->con->query($query) as $key => $value){
						$permisos['cod'][$key] = $value['cod'];
						$permisos['seccion'][$key] = $value['seccion'];
					}	
						
					$_SESSION['usuario']['permisos'] = $permisos;
				}
			} 
        }
		
		/**
	* Login de usuario
	*/
	
        public function notLogged(){
            if(!isset($_SESSION['usuario'])){
				return true;
			}
			return false;
        }
}
?>
