<?php
    class Plataformas{

        private $con;

        function __construct($con){
            $this->con = $con;
        }
        public function getPlataformas(){
            $query = "SELECT * FROM PLATAFORMAS WHERE Estado = 1";
            return $this->con->query($query);
        }
    }
?>