<?php 
Class Campo_comentario{

	private $con;
	
	public function __construct($con){
		$this->con = $con;
	}
	
	public function get($id){
		$query = "SELECT *
				FROM campos_dinamicos
				WHERE id_din = ".$id;

		$query = $this->con->query($query); 
		$comentario = $query->fetch(PDO::FETCH_OBJ);

		return $comentario; 
	}

	public function getList(){
		

		$query = "SELECT * 
				FROM campos_dinamicos
				WHERE enabled = 1";
		return $this->con->query($query); 
	}
	
	public function save($data){
		
		$hayOpcion = 0;
		var_dump($data); die();
		foreach($data as $key => $value){
			
			if(!is_array($value)){
				if($value != null){
					if($key != "option"){
						$datos[] = '';
					}
					$columns[]=$key;
					$datos[]=$value;
				}
			}
		}

		//var_dump($datos);die();
		$sql = "INSERT INTO campos_dinamicos(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
		//echo $sql;die();
		
		$this->con->exec($sql);
			
	} 
	
	public function edit($data){

		$id = $data['id_din'];
		unset($data['id_din']);
		
		$hayOpcion = 0;
		foreach($data as $key => $value){
			if(!is_array($value)){
				if($value != null){
					if($key == "opcion"){
						$hayOpcion = 1;
					}
					$columns[]=$key." = '".$value."'"; 
				}
			}
		}
		
		if($hayOpcion == 0){
			$columns[]= "opcion = ''";
		}		
		$sql = "UPDATE campos_dinamicos SET ".implode(',',$columns)." WHERE id_din = ".$id;		
		$this->con->exec($sql);			
		
	}	 

	public function del($id){

		$query = "	SELECT 
						COUNT(*) AS cantidad 
					FROM comentarios_campos_din 
					WHERE id_campo = ".$id;
		
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);

		if($consulta->cantidad == 0){
			$query = "UPDATE campos_dinamicos  SET enabled = 0, estado = 0 WHERE id_din = ".$id; 
			$this->con->exec($query); 
			return 1;
		}
		return 'Campo dinámico asignado a algún comentario.';
	}

	public function update($modif, $id){
		$act = ($modif -1) * -1;
		$this->con->exec("UPDATE campos_dinamicos SET estado = ".$act." WHERE id_din = ".$id);
	}

}