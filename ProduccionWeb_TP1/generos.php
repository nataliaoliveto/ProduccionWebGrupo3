<?php
    class Generos{

        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getGeneros(){
            $query = "SELECT * FROM GENEROS WHERE Estado = 1";
            return $this->con->query($query);
        }
    }
?>