<?php
    class Productos{

        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getProductosRandom(){
            $query = "SELECT * FROM Productos WHERE Estado = 1 AND Destacado = 1 ORDER BY RAND() LIMIT 6";
            return $this->con->query($query);
        }
        
        public function getProductoUnico($prodId){
            $query = "SELECT * FROM Productos WHERE ID = $prodId";
            return $this->con->query($query);          
        }

        public function getProductos($platID, $genID, $edadID, $sortID){
            $query = "SELECT * FROM productos WHERE Estado = 1 AND (Plataforma = $platID OR $platID = 0) AND (Genero = $genID OR $genID = 0) AND (Edad = $edadID OR $edadID = 0)";
            switch($sortID){
                case "1":
                    $query .= "ORDER BY Destacado DESC, RAND()";
                    break;
                case "2":
                    $query .= "ORDER BY Nombre ASC";
                    break;
                case "3":
                    $query .= "ORDER BY Nombre DESC";
                    break; 
            }
            return $this->con->query($query);
        }
    }    
?>
