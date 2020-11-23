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
                $this->con->exec($sql);
                
                $query = "	SELECT
							MAX(id)
						FROM comentarios";

                $id_comentario = $this->con->query($query)->fetchColumn();
                
                $query = "  SELECT
                                id_din
                            FROM producto_campos_dinamicos
                            WHERE id_prod =".$data['IDproducto'];
                            
                foreach ($this->con->query($query) as $iddin) {
                    if(isset($data['valor_ingresado'.$iddin['id_din']])){
                        $valoringresado = $data['valor_ingresado'.$iddin['id_din']];
                    }else{
                        $valoringresado = 0;
                    }

                    $sql = "INSERT INTO comentarios_campos_din (id_comentario, id_campo, valor_ingresado) 
                            VALUES(".$id_comentario.", ".$iddin['id_din']." , '".$valoringresado."')";                                                 
                    $this->con->exec($sql);
                }                          
            }
        }

        public function getCamposDin($idcom){

            $query = "	SELECT
                            CD.label, 
                            CD.type,
                            CCD.valor_ingresado
                        FROM comentarios_campos_din CCD
                        INNER JOIN campos_dinamicos CD ON
                            CCD.id_campo = CD.id_din
                        WHERE CCD.id_comentario = ". $idcom;
    
            return $this->con->query($query);
    
        }

    }
?>