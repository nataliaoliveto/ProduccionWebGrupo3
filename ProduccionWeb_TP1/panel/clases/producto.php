<?php 
Class Producto{

    /*OK*/
	private $con;
	/*OK*/
	public function __construct($con){
		$this->con = $con;
	}
	/*OK*/
	public function getList($genID, $edadID, $pag){
		$desde = ($pag - 1) * 10;
        $hasta = $desde + 10;
		$query = "SELECT id, nombre, descripcion, precio, plataforma, genero, edad, estado
					FROM productos
					WHERE enabled = '1' AND (genero = ".$genID." OR ".$genID." = 0) AND (edad = ".$edadID." OR ".$edadID." = 0)
					LIMIT $desde, $hasta";
        return $this->con->query($query); 
	}

	/*OK*/
	public function get($id){
		$query = "SELECT id, nombre, descripcion, precio, destacado, stock, desarrollador, fechadelanzamiento, plataforma, genero, edad
					FROM productos WHERE id = ".$id;
        $query = $this->con->query($query); 

		$prod = $query->fetch(PDO::FETCH_OBJ);
			
			$sql = 'SELECT id_prod, id_din
					FROM producto_campos_dinamicos  
					WHERE id_prod = '.$prod->id;
					
			foreach($this->con->query($sql) as $prod_din){
				$prod->prod_din[] = $prod_din['id_din'];
			}
			/*echo '<pre>';
			var_dump($perfil);echo '</pre>'; */
            return $prod;
	}

	public function update($modif, $id){
		$act = ($modif -1) * -1;
		$this->con->exec("UPDATE productos SET estado = ".$act." WHERE id = ".$id);
	}

	/*public function getCamposDinamicos($id){
		$query = " SELECT id_prod, id_din
					FROM producto_campos_dinamicos  
					WHERE id_prod = ".$id;

			foreach($this->con->query($query) as $prod_din){
				$prod->prod_din[] = $prod_din['id_din'];
			}
		return $this->con->query($query);
	}*/

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

	public function getPlataformas(){
		$query = "	SELECT *
					FROM plataformas 
					WHERE plataformas.enabled = 1 AND plataformas.estado = 1 ";
		return $this->con->query($query); 
	}

	public function getGeneros(){
		$query = "SELECT G.id, G.nombre, G.estado, G.enabled FROM generos G INNER JOIN genero_edades GE ON G.id = GE.idgen WHERE G.estado = 1 AND G.enabled = 1 GROUP BY G.id, G.nombre, G.estado, G.enabled";
		return $this->con->query($query);
	}

	public function getGeneroEdades($genID){
		$query = "SELECT * FROM genero_edades WHERE idgen = $genID AND genero_edades.enabled = 1";
		return $this->con->query($query);
	}

	public function getGeneroEdadesTotal(){
		$query = "SELECT * FROM genero_edades WHERE genero_edades.enabled = 1";
		return $this->con->query($query);
	}

	public function getEdadNombre($edadID){
		$query = "SELECT * FROM edades WHERE estado = 1 AND id = $edadID AND edades.enabled = 1";
		return $this->con->query($query);
	}	
	
	public function getEdades(){
		$query = "SELECT * FROM edades WHERE estado = 1 AND edades.enabled = 1";
		return $this->con->query($query);
	}

	public function del($id){
			$query = "UPDATE productos SET enabled = 0, estado = 0 WHERE id = ".$id; 
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
			
			//$id_prod = $this->con->lastInsertId();

			$sql = "	SELECT
							MAX(id)
						FROM productos";

			$id_prod = $this->con->query($sql)->fetchColumn(); 
			$id = $id_prod;
			include 'funcs.php';

			if(isset($_FILES['imagen']))
			//	var_dump($_FILES['imagen']); die;

			if(isset($_FILES['imagen'])){
				$tamanhos = array(0 => array('nombre'=>'caratula','ancho'=>'580','alto'=>'730'),
								1 => array('nombre'=>'caratulamin','ancho'=>'290','alto'=>'365'),
								);
				$ruta = '../imagenes/'. $id .'/';
				if(!is_dir($ruta))
					mkdir($ruta);	
				//	var_dump($id)	; die;	  
				
				redimensionar($ruta,$_FILES['imagen']['name'],$_FILES['imagen']['tmp_name'],$id,$tamanhos);
			}
			include 'func2.php';


				if(isset($_FILES['caro'])){
					$tamanhos = array(0 => array('nombre'=>'carouseln','ancho'=>'1000','alto'=>'500')
									);
				
					$ruta = '../imagenes/'.$id.'/';
					if(!is_dir($ruta))
						mkdir($ruta);			  
					
					foreach($_FILES['caro']['name'] as $pos=>$nombre){
						redimensionar($ruta,$_FILES['caro']['name'][$pos],$_FILES['caro']['tmp_name'][$pos],$pos,$tamanhos);
					}
					redimensionar($ruta,$_FILES['caro']['name'],$_FILES['caro']['tmp_name'],0,$tamanhos);
				}



			$sql = '';
			foreach ($data['extrainfo'] as $extrainfo) {
				$sql .= "	INSERT INTO producto_extra_info(id_producto, label, texto) 
							VALUES (". $id_prod .",'".implode("','",$extrainfo)."')";
			}
			$this->con->exec($sql);

			/*
			$sql='';
			foreach($data['campos_din'] as $campos_din){
				$sql .= 'INSERT INTO producto_campos_dinamicos(id_prod,id_din) 
							VALUES ('.$id.','.$campos_din.');';
			}
			//echo $sql;die();
			$this->con->exec($sql);
			/*
			
			$sql = '';
			foreach($data['permisos'] as $permisos){
				$sql .= 'INSERT INTO perfil_permisos(perfil_id,permiso_id) 
							VALUES ('.$id.','.$permisos.');';
			}
			//echo $sql;die();
			$this->con->exec($sql);*/
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
		include 'funcs.php';
		
		if(isset($_FILES['imagen']))
		//	var_dump($_FILES['imagen']); die;

		if(isset($_FILES['imagen'])){
			$tamanhos = array(0 => array('nombre'=>'caratula','ancho'=>'580','alto'=>'730'),
							1 => array('nombre'=>'caratulamin','ancho'=>'290','alto'=>'365'),
							);
			$ruta = '../imagenes/'. $id .'/';
			if(!is_dir($ruta))
				mkdir($ruta);	
			//	var_dump($id)	; die;	  
			
			redimensionar($ruta,$_FILES['imagen']['name'],$_FILES['imagen']['tmp_name'],$id,$tamanhos);
		} 

		include 'func2.php';


				if(isset($_FILES['caro'])){
					$tamanhos = array(0 => array('nombre'=>'carouseln','ancho'=>'1000','alto'=>'500')
									);
				
					$ruta = '../imagenes/'.$id.'/';
					if(!is_dir($ruta))
						mkdir($ruta);			  
					
					foreach($_FILES['caro']['name'] as $pos=>$nombre){
						redimensionar($ruta,$_FILES['caro']['name'][$pos],$_FILES['caro']['tmp_name'][$pos],$pos,$tamanhos);
					}
					redimensionar($ruta,$_FILES['caro']['name'],$_FILES['caro']['tmp_name'],0,$tamanhos);
				}


		$sql = "UPDATE productos SET ".implode(',',$columns)." WHERE id = ".$id;
		//echo $sql; die();
		$this->con->exec($sql); 

		$sql = 'DELETE FROM producto_campos_dinamicos WHERE id_prod= '.$id;
		$this->con->exec($sql);

		$sql='';
		foreach($data['campos_din'] as $campos_din){
			$sql .= 'INSERT INTO producto_campos_dinamicos(id_prod,id_din) 
						VALUES ('.$id.','.$campos_din.');';
		}
		//echo $sql; die();
		$this->con->exec($sql);
		//var_dump($sql); die();
		

		$sql = 'DELETE FROM producto_extra_info WHERE id_producto= '.$id;
		$this->con->exec($sql);

		foreach ($data['extrainfo'] as $extrainfo) {
			$sql .= "	INSERT INTO producto_extra_info(id_producto, label, texto) 
						VALUES (". $id .",'".implode("','",$extrainfo)."')";
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
					WHERE enabled = 1 AND (genero = ".$genID." OR ".$genID." = 0) AND (edad = ".$edadID." OR ".$edadID." = 0)";

		return $this->con->query($query)->fetchColumn(); 
	}

	public function getCountComentarios($id){
		$query = "	SELECT 
						COUNT(*)
					FROM comentarios 
					WHERE IDproducto = ".$id;

		return $this->con->query($query)->fetchColumn(); 
	}

	public function getProducto_extra_info($id){
		$query = "SELECT * FROM producto_extra_info WHERE id_producto = ".$id;
		return $this->con->query($query);
	}
}
