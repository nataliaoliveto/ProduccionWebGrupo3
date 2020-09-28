<?php
    class Edades{
        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getGeneroEdades($genID){
            $query = "SELECT * FROM GENERO_EDADES WHERE IDGen = $genID";
            return $this->con->query($query);
        }

        public function getEdadNombre($edadID){
            $query = "SELECT * FROM EDADES WHERE Estado = 1 AND ID = $edadID";
            return $this->con->query($query);
        }
    }
?>