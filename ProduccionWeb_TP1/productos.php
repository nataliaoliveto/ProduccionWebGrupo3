<?php
    class Productos{

        private $con;

        function __construct($con){
            $this->con = $con;
        }

        public function getProductosRandom(){            
            $query = "( 
                        SELECT P.id, P.nombre, descripcion, plataforma, genero, precio 
                        FROM productos P 
                        INNER JOIN plataformas PL on P.plataforma = PL.id 
                        INNER JOIN generos G on P.genero = G.id 
                        INNER JOIN edades E ON P.edad = E.id 
                        WHERE P.estado = 1 AND P.destacado = 1 AND PL.estado = 1 AND G.estado = 1 AND E.estado = 1
                    )
                    UNION
                    (	
                        SELECT P.id, MAX(P.nombre), MAX(P.descripcion), MAX(P.plataforma), MAX(P.genero), MAX(P.precio) 
                        FROM productos P 
                        INNER JOIN comentarios C ON P.id = C.IDproducto 
                        INNER JOIN plataformas PL ON P.plataforma = PL.id 
                        INNER JOIN generos G ON P.genero = G.id 
                        INNER JOIN edades E ON P.edad = E.id 
                        WHERE P.estado = 1 AND PL.estado = 1 AND G.estado = 1 AND E.estado = 1 
                        GROUP BY P.id 
                        ORDER BY AVG(C.calificacion) DESC LIMIT 10
                    )
                    ORDER BY RAND() LIMIT 6";
            return $this->con->query($query);
        } 
        
        public function getProductoUnico($prodId){
            $query = "  SELECT P.id, P.nombre, P.descripcion, P.plataforma, P.genero, P.precio, P.stock, P.desarrollador, P.fechadelanzamiento, ROUND(AVG(C.calificacion),1) AS calificacion  
                        FROM productos P 
                        LEFT JOIN comentarios C ON P.id = C.IDproducto 
                        INNER JOIN plataformas PL ON P.plataforma = PL.id 
                        INNER JOIN generos G ON P.genero = G.id 
                        INNER JOIN edades E ON P.edad = E.id 
                        WHERE P.id = $prodId
                        GROUP BY P.id, P.nombre, P.descripcion, P.genero, P.plataforma, P.precio, P.stock, P.desarrollador, P.fechadelanzamiento ";

            return $this->con->query($query);          
        }

        public function getProductos($platID, $genID, $edadID, $sortID){            
            $query = "  SELECT P.id, P.nombre, P.descripcion, P.plataforma, P.genero, P.precio 
                        FROM productos P 
                        LEFT JOIN comentarios C ON P.id = C.IDproducto 
                        INNER JOIN plataformas PL ON P.plataforma = PL.id 
                        INNER JOIN generos G ON P.genero = G.id 
                        INNER JOIN edades E ON P.edad = E.id 
                        WHERE P.estado = 1 AND PL.estado = 1 AND G.estado = 1 AND E.estado = 1 AND (P.plataforma = $platID OR $platID = 0) AND (P.genero = $genID OR $genID = 0) AND (P.edad = $edadID OR $edadID = 0) 
                        GROUP BY P.id, P.nombre, P.descripcion, P.genero, P.plataforma, P.precio ";

            switch($sortID){
                case "1":
                    $query .= "ORDER BY P.destacado DESC, RAND()";
                    break;
                case "2":
                    $query .= "ORDER BY P.nombre ASC";
                    break;
                case "3":
                    $query .= "ORDER BY P.nombre DESC";
                    break;
                case "4":
                    $query .= "ORDER BY AVG(C.calificacion) DESC";
                    break; 
            }
            return $this->con->query($query);
        }

        public function getProducto_extra_info($id){
            $query = "SELECT * FROM producto_extra_info WHERE id_producto = ".$id;
            return $this->con->query($query);
        }

        public function getProducto_campos_dinamicos($id){
            $query = "  SELECT 
                            CD.id_din,
                            CD.label,
                            CD.type,
                            CD.opcion,
                            CD.required
                        FROM producto_campos_dinamicos PCD
                        INNER JOIN campos_dinamicos CD ON  
                            PCD.id_din = CD.id_din
                        WHERE PCD.id_prod = ".$id. " AND CD.estado = 1";
            
            return $this->con->query($query);
            
        }
    }    
?>
