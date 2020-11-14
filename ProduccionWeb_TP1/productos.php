<?php
    class Productos{

        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getProductosRandom(){
            $query = "SELECT * FROM productos WHERE estado = 1 AND destacado = 1 ORDER BY RAND() LIMIT 6";
            return $this->con->query($query);
        }
        
        public function getProductoUnico($prodId){
            $query = "SELECT * FROM productos WHERE id = $prodId";
            return $this->con->query($query);          
        }

        public function getProductos($platID, $genID, $edadID, $sortID){
            $query = "SELECT * FROM productos WHERE estado = 1 AND (plataforma = $platID OR $platID = 0) AND (genero = $genID OR $genID = 0) AND (edad = $edadID OR $edadID = 0)";
            switch($sortID){
                case "1":
                    $query .= "ORDER BY destacado DESC, RAND()";
                    break;
                case "2":
                    $query .= "ORDER BY nombre ASC";
                    break;
                case "3":
                    $query .= "ORDER BY nombre DESC";
                    break; 
            }
            return $this->con->query($query);
        }
    }    
?>


