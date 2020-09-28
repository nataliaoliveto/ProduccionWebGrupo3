<!DOCTYPE html>
<html lang="es">


<body>

    <?php
    require "header.php";    
    ?>

    <main>
        <section>
            <div class="container mt-3 d-xs-block">
                <div id="micarousel" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#micarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#micarousel" data-slide-to="1"></li>
                        <li data-target="#micarousel" data-slide-to="2"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="imagenes/carouselinicio1.jpg" alt="Ultimo lanzamiento" width="1000" height="500">
                        </div>
                        <div class="carousel-item">
                            <img src="imagenes/carouselinicio2.jpg" alt="Próximos lanzamientos" width="1000" height="500">
                        </div>
                        <div class="carousel-item">
                            <img src="imagenes/carouselinicio3.jpg" alt="El más vendido" width="1000" height="500">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#micarousel" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#micarousel" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
            <div id="iniciogrillaimg" class="container">
                <div class="row">
                <?php 
                    for ($i=1; $i<10; $i++){
                    echo ' <div class="col-4 inicioimagen">
                            <img src="imagenes/grilla'.$i.'.jpg" alt="Juego '.$i.' en grilla de imágenes" width="400" height="250" class="img-fluid">
                            </div>';
                    }
                    ?>
                </div>
            </div>
        </section>        
        <section>
            <?php require "filtro.php"; ?>
            <div class="container listadodivcards">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="tituloseccion"><img src="imagenes/iconos/iconodestacados65.jpg" alt="Icono destacados tamaño 65" width="65" height="65" class="img-fluid rounded-circle"> Destacados</h1>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $hayDestacados = false;
                    foreach ($Prod->getProductosRandom() as $productito){
                        $hayDestacados = true;
                    ?>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                            <article class="card">
                                <a href="detalleproductos.php?prod=<?php echo $productito['id'] ?>"><img src="imagenes/<?php echo $productito['id'] . '/caratula.jpg' ?>" alt="Carátula <?php echo $productito['nombre'] ?>" width="580" height="730" class="img-fluid"></a>
                                <h2><a href="detalleproductos.php?prod=<?php echo $productito['id'] ?>"><?php echo $productito['nombre'] . "<br />"; ?></a></h2>
                                <div class="visualcard">
                                    <p><?php echo ucfirst(substr($productito['descripcion'], 0, 125)); ?><a href="detalleproductos.php?prod=<?php echo $productito['id'] ?>"> Ver más...</a></p>
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
                                        <p class="listadoprecio"><img src="imagenes/iconos/iconocomprablanco.png" alt="Icono compra blanco" width="25" height="25" class="img-fluid float-left"><?php echo "$" . $productito['precio'] . "<br />"; ?></p>
                                    </a>
                                </div>
                            </article>
                        </div>
                    <?php
                    }
                    if(!$hayDestacados){
                        echo '<img src="imagenes/no-products-found.png" alt="No hay destacados" width="260" height="344" class="img-fluid"/>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <?php
    require "footer.php";
    ?>
</body>

</html>