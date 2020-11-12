<?php
    class Plataformas{

        private $con;

        function __construct($con){
            $this->con = $con;
        }
        public function getPlataformas(){
            $query = "SELECT * FROM plataformas WHERE estado = 1";
            return $this->con->query($query);
        }
    }
?>