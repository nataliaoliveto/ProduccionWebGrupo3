<?php
    class Generos{

        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getGeneros(){
            $query = "SELECT * FROM generos WHERE estado = 1";
            return $this->con->query($query);
        }
    }
?>