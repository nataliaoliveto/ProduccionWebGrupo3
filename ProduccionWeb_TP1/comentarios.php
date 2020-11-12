<?php
    class Comentarios{

        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getComentarios($prodID){
            $query = "SELECT * FROM comentarios WHERE idproducto = $prodID AND estado = 1 ORDER BY id DESC LIMIT 10";
            return $this->con->query($query);
        }

        public function validaComentario($prodID){
            $query = "SELECT COUNT(*) FROM comentarios WHERE ip = '".$_SERVER['REMOTE_ADDR']."' AND CAST(now() AS DATE)  = CAST(fecha AS DATE) AND idproducto = $prodID";
            return $this->con->query($query)->fetchColumn();           
        }

        public function setComentarios($data = array()){
            
            if(!empty($data)){

                $sql = "INSERT INTO comentarios (mail, descripcion, idproducto, calificacion, fecha, estado, ip) VALUES ('".$data['mail']."', '".$data['descripcion']."', ".$data['IDproducto'].", ".$data['calificacion'].", now(), false, '".$_SERVER['REMOTE_ADDR']."')";                 
                
                if($this->con->exec($sql) > 0){
                    return 'comentario almacenado';
                }else{
                    return 'error';
                }
                
            }

        }
    }
?>