<!DOCTYPE html>
<html lang="es">

<?php
require "header.php";
require "comentarios.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
$Comen = new Comentarios($con);
?>

<body>
    <?php
    foreach ($Prod->getProductoUnico($_GET['prod']) as $prod) {       
    }
    ?>

    <main>
        <?php  
        $calificacion = '0';
        $huboComentario = false;
        $ipOK = false;
        if (isset($_POST['comentar'])) {
            $huboComentario = true;
            $data = $_POST;
            //var_dump($data); die();            
            if(isset($data['calificacion'])){
                $calificacion = $data['calificacion'];
            };
            unset($data['comentar']);
            if($Comen-> validaComentario($_GET['prod']) == 0){
                $ipOK = true;
                if ($calificacion != '0') {  // Chequeo que hayan calificado el producto antes de agregarlo
                    $Comen-> setComentarios($data);
                }
            }            
        }
        ?>
        <section>
            <div class="container" id="cuerpodetalle">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="tituloseccioncontacto"><img src="imagenes/iconos/iconodetalle65.jpg" alt="Icono detalle tamaño 65" width="65" height="65" class="img-fluid rounded-circle"><?php echo $prod['nombre']; ?></h1>
                    </div>
                </div>
                <div id=carouseldetalle class="container">
                    <div class="container mt-3 d-xs-block">
                        <div id="micarousel" class="carousel slide" data-ride="carousel">
                            <ul class="carousel-indicators">
                                <li data-target="#micarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#micarousel" data-slide-to="1"></li>
                                <li data-target="#micarousel" data-slide-to="2"></li>
                            </ul>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="imagenes/<?php echo $prod['id'] . '/carouseln1.jpg' ?>" alt="Detalle 1 del juego" width="1000" height="500">
                                </div>
                                <div class="carousel-item">
                                    <img src="imagenes/<?php echo $prod['id'] . '/carouseln2.jpg' ?>" alt="Detalle 2 del juego" width="1000" height="500">
                                </div>
                                <div class="carousel-item">
                                    <img src="imagenes/<?php echo $prod['id'] . '/carouseln3.jpg' ?>" alt="Detalle 3 del juego" width="1000" height="500">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#micarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#micarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                        <h2><?php echo $prod['nombre']; ?></h2>
                        <p><?php echo $prod['descripcion']; ?>
                        </p>
                        <div class="container">
                            <div class="detalletodos">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <p><img src="imagenes/iconos/iconocalificacion50.png" alt="Icono calificación" width="50" height="50">Calificación: <?php echo $prod['calificacion'] . "/5"; ?></p>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <p><img src="imagenes/iconos/iconogenero50.png" alt="Icono género" width="50" height="50">Género: <?php
                                            foreach ($Gen->getGeneros() as $generito) {
                                                if ($generito['id'] == $prod['genero']) {
                                                    echo $generito['nombre'] . "<br />";
                                                }
                                            } ?></p>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <p><img src="imagenes/iconos/iconoplataforma50.png" alt="Icono plataforma" width="50" height="50">Plataforma: <?php
                                            foreach ($Plat->getPlataformas() as $plataformita) {
                                                if ($plataformita['id'] == $prod['plataforma']) {
                                                    echo $plataformita['nombre'] . "<br />";
                                                }
                                            } ?></p>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <p><img src="imagenes/iconos/iconofecha50.png" alt="Icono fecha de lanzamiento" width="50" height="50">Fecha de Lanzamiento: <?php echo $prod['fechadelanzamiento']; ?></p>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <p><img src="imagenes/iconos/iconostock50.png" alt="Icono stock" width="50" height="50">Stock: <?php echo $prod['stock'] . " unidades disponibles"; ?></p>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <p><img src="imagenes/iconos/iconodesarrollador50.png" alt="Icono desarrollador" width="50" height="50">Desarrollado por: <?php echo $prod['desarrollador'];  ?></p>
                                    </div>
                                        <?php foreach($Prod->getProducto_extra_info($_GET['prod']) as $prodExtra){ ?>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <p><img src="imagenes/iconos/iconoextra50.png" alt="Icono info extra" width="40" height="40"><?php echo $prodExtra['label'].': '.$prodExtra['texto']; ?></p>
                                        </div>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container listadodivcards">
                <h3>¿Te gustó este juego? ¡No te pierdas los siguientes!</h3>
                <div class="row">
                    <?php
                    $cantidad = 0;
                    foreach ($Prod->getProductos(0,$prod['genero'],0,0) as $productito) {
                            if ($prod['nombre'] != $productito['nombre']) {
                                $cantidad++;
                                if ($cantidad == 5) break;
                                ?>
                                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-4">
                                    <article class="card cardmini">
                                        <a href="detalleproductos.php?prod=<?php echo $productito['id'] ?>"><img src="imagenes/<?php echo $productito['id'] . '/caratulamin.jpg' ?>" alt="Carátula <?php echo $productito['nombre'] ?>" width="290" height="365" class="img-fluid"></a>
                                        <a href="detalleproductos.php?prod=<?php echo $productito['id'] ?>">
                                            <h4><?php echo $productito['nombre'] . "<br />"; ?></h4>
                                        </a>
                                        <div class="visualcardmini">
                                            <p><?php echo ucfirst(substr($productito['descripcion'], 0, 65)); ?><a href="detalleproductos.php?prod=<?php echo $productito['id'] ?>"> Ver más...</a></p>
                                            <p class="listadogenero">Género: <?php
                                                foreach ($Gen->getGeneros() as $generito) {
                                                    if ($generito['id'] == $productito['genero']) {
                                                        echo $generito['nombre'] . "<br />";
                                                    }
                                                } ?></p>
                                            <p class="listadoplataforma"><?php
                                                foreach ($Plat->getPlataformas() as $plataformita) {
                                                    if ($plataformita['id'] == $productito['plataforma']) {
                                                        echo $plataformita['nombre'] . "<br />";
                                                    }
                                                } ?></p>
                                            <a href=#stophere>
                                                <p class="listadoprecio"><img src="imagenes/iconos/iconocomprablanco.png" alt="Icono compra blanco" width="20" height="20" class="img-fluid float-left"><?php echo "$" . $productito['precio'] . "<br />"; ?></p>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                                <?php
                            }
                    }
                    ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container listadodivcards">
                <h3 class="comentariosconicono"><img src="imagenes/iconos/iconocomentarios65.jpg" alt="Icono comentarios tamaño 65" width="65" height="65" class="img-fluid rounded-circle"> COMENTARIOS</h3>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <article>
                            <form role="form" action="" method="post">
                                <fieldset >
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h4>¡Valora el juego!</h4>
                                            <div class="control-group">
                                                <p class="clasificacion">
                                                    <input id="radio1" type="radio" name="calificacion" value="5">
                                                    <label for="radio1">★</label>
                                                    <input id="radio2" type="radio" name="calificacion" value="4">
                                                    <label for="radio2">★</label>
                                                    <input id="radio3" type="radio" name="calificacion" value="3">
                                                    <label for="radio3">★</label>
                                                    <input id="radio4" type="radio" name="calificacion" value="2">
                                                    <label for="radio4">★</label>
                                                    <input id="radio5" type="radio" name="calificacion" value="1">
                                                    <label for="radio5">★</label>
                                                </p>
                                            </div>

                                            
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php foreach($Prod->getProducto_campos_dinamicos($_GET['prod']) as $prodCamposDin){ 
                                                        $html = ""; ?>
                                                        <?php //echo $prodCamposDin['label'].$prodCamposDin['type'].$prodCamposDin['opcion'].$prodCamposDin['required']; 
                                                        switch($prodCamposDin['type']){
                                                            case "text":
                                                                $html = $prodCamposDin['label'].'<br><textarea rows="3" cols="40" class="input-xlarge" name="valor_ingresado'.$prodCamposDin['id_din'].'"></textarea>';
                                                                break;
                                                            case "option":
                                                                $opciones = explode('|', $prodCamposDin['opcion']);
                                                                $html = '<div class="form-group">'.$prodCamposDin['label'].'<select name="valor_ingresado'.$prodCamposDin['id_din'].'"'.($prodCamposDin['required'] == 1 ? 'required' : '').'>';
                                                                for($i = 0; $i < count($opciones); $i++){
                                                                    $html .= '<option value = '.$opciones[$i].'>'.$opciones[$i].'</option>';
                                                                }   
                                                                $html .= '</select></div>';
                                                                break;
                                                            case "checkbox": 
                                                                $html = '<div class="checkbox">'.$prodCamposDin['label'].'<input type="hidden" name="valor_ingresado" value= 0 ><input type="checkbox" name="valor_ingresado'.$prodCamposDin['id_din'].'" value = 1 ></div>';
                                                                break; 
                                                        }  echo $html; 
                                                    } ?>
                                                </div>
                                            </div>
                                            
                                            
											
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="control-group">
                                                        Email: <input type="email" placeholder="email" class="input-xlarge" name="mail" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="control-group">
                                                        <br>
                                                        <textarea rows="5" cols="40" id="textarea" class="input-xlarge" name="descripcion"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" class="input-xlarge" name="IDproducto" value="<?php echo $_GET['prod'] ?>" />                                            
                                            <button type="submit" name="comentar" class="button">Comentar</button>
                                            <?php                                                
                                                if ($huboComentario) {
                                                    
                                                    if(!$ipOK){
                                                        ?>                                                      
                                                            <p id="errorComentario"> Error al cargar el comentario: no se puede ingresar más de un comentario por día. </p>
                                                        <?php
                                                    }else{
                                                        if ($calificacion == '0') {
                                                            ?>                                                      
                                                                <p id="errorComentario"> Error al cargar comentario: es necesario valorar el producto. </p>
                                                            <?php
                                                        } else {
                                                            ?>                                                      
                                                                <p id="okComentario"> Su comentario será procesado... suerte! </p>
                                                            <?php
                                                        } 
                                                    }
                                                } 
                                            ?>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </article>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <?php
                        $comentarioArray = $Comen->getComentarios($_GET['prod']);
                            
                        $existeComentario = false;
                        foreach ($comentarioArray as $comentario) {
                            
                            $existeComentario = true;
                            ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <article class="card cardcomentarios">
                                    <p class="clasificacion" id="estrella"><?php
                                        if (isset($comentario['calificacion'])) {
                                            switch ($comentario['calificacion']) {
                                                case 1:
                                                    echo '★';
                                                    break;
                                                case 2:
                                                    echo '★★';
                                                    break;
                                                case 3:
                                                    echo '★★★';
                                                    break;
                                                case 4:
                                                    echo '★★★★';
                                                    break;
                                                case 5:
                                                    echo '★★★★★';
                                                    break;
                                            }
                                        } else {
                                            echo 'ฅ^•ﻌ•^ฅ';
                                        }
                                        ?></p>
                                    <p class="fechacomentarios"><?php echo $comentario['fecha']; ?></p>
                                    <p class="emailcomentarios"><?php echo $comentario['mail']; ?></p>
                                    <p class="pcomentarios"><?php echo $comentario['descripcion']; ?></p>
                                    <p class="pcomentariosdin">
                                    <?php 
                                        foreach ($Comen->getCamposDin($comentario['id']) as $camposdin) {
                                            $valor = '';
                                            if ($camposdin['type'] == 'checkbox') {
                                                if ($camposdin['valor_ingresado'] == '1') {
                                                    $valor = 'Sip =)';
                                                } else {
                                                    $valor = 'Nope >=(';
                                                }
                                                
                                            } else {
                                                $valor = $camposdin['valor_ingresado'];
                                            }
                                            
                                            echo $camposdin['label']. ": ". $valor;
                                            ?> <br> <?php
                                        }
                                    ?>
                                    </p>
                                </article>
                            </div>
                        <?php  
                        }
                        if(!$existeComentario){
                            ?>   <p> ¡Deja tu opinión en un comentario!</p> <?php 
                        }?>
                </div>
            </div>
        </section>
    </main>
    <?php
    require "footer.php";
    ?>
</body>
</html>