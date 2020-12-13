<?php
    class Edades{
        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getGeneroEdades($genID){
            $query = "  SELECT * 
                        FROM genero_edades GE 
                        INNER JOIN edades E ON GE.idedad = E.id 
                        WHERE GE.idgen = $genID AND E.estado = 1";            
            return $this->con->query($query);
        }

        public function getEdadNombre($edadID){
            $query = "SELECT * FROM edades WHERE estado = 1 AND id = $edadID";
            return $this->con->query($query);
        }
    }
?>
