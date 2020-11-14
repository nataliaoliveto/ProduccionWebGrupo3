<?php 
Class UsuarioTipos{

    /*conexion a la base*/
	private $con;
	
	public function __construct($con){
		$this->con = $con;
	}

	public function getList(){
		$query = "SELECT id_tipo,tipo 
		           FROM usuarios_tipos";
        return $this->con->query($query); 
	}
}
?>