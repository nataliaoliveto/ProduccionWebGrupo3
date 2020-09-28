<?php
    class Comentarios{

        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getComentarios($prodID){
            $query = "SELECT * FROM COMENTARIOS WHERE IDproducto = $prodID AND estado = 1 ORDER BY ID DESC LIMIT 10";
            return $this->con->query($query);
        }

        public function validaComentario($prodID){
            $query = "SELECT COUNT(*) FROM COMENTARIOS WHERE IP = '".$_SERVER['SERVER_ADDR']."' AND CAST(now() AS DATE)  = CAST(fecha AS DATE) AND IDproducto = $prodID";
            return $this->con->query($query)->fetchColumn();           
        }

        public function setComentarios($data = array()){
            
            if(!empty($data)){

                $sql = "INSERT INTO COMENTARIOS (mail, descripcion, IDproducto, calificacion, fecha, estado, IP) VALUES ('".$data['mail']."', '".$data['descripcion']."', ".$data['IDproducto'].", ".$data['calificacion'].", now(), false, '".$_SERVER['SERVER_ADDR']."')";                 
                
                if($this->con->exec($sql) > 0){
                    return 'comentario almacenado';
                }else{
                    return 'error';
                }
                
            }

        }
    }
?>