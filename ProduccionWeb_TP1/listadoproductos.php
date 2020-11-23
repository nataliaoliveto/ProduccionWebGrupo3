<!DOCTYPE html>
<html lang="es">

<?php 
    require "header.php";
    require "filtro.php";
?>

<body>

    <main>
        <section>

            <div class="container listadodivcards">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="tituloseccion"><img src="imagenes/iconos/iconocatalogo65.jpg" alt="Icono catálogo tamaño 65" width="65" height="65" class="img-fluid rounded-circle"> CATÁLOGO DE PRODUCTOS</h1>
                    </div>
                </div>

                <div class="row">

                    <?php 
                    
                    $platID = empty($_GET['plataformas']) ? 0 : $_GET['plataformas'];
                    $genID = empty($_GET['generos']) ? 0 : $_GET['generos'];
                    $sortID = empty($_GET['sort']) ? 0 : $_GET['sort'];
                    $edadID = empty($_GET['edades']) ? 0 : $_GET['edades'];
                    $hayProductos = false;
                    foreach ($Prod->getProductos($platID, $genID, $edadID, $sortID) as $productito){
                    $hayProductos = true;
					?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                        <article class="card">
                            <a href="detalleproductos.php?prod=<?php echo $productito['id']?>"><img src="imagenes/<?php echo $productito['id']. '/caratula.jpg' ?>" alt="Carátula <?php echo $productito['nombre'] ?>" width="580" height="730" class="img-fluid"></a>
                            <h2><a href="detalleproductos.php?prod=<?php echo $productito['id']?>"><?php echo $productito['nombre'] . "<br />"; ?></a></h2>
                            <div class="visualcard">
                            <p><?php echo ucfirst(substr($productito['descripcion'],0,120)); ?><a href="detalleproductos.php?prod=<?php echo $productito['id']?>"> Ver más...</a></p>
                            <p class="listadogenero">Género: <?php 
                            foreach($Gen->getGeneros() as $generito){
                                if($generito['id'] == $productito['genero']){
                                    echo $generito['nombre']. "<br />"; } } ?></p>
                            <p class="listadoplataforma"><?php 
                            foreach($Plat->getPlataformas() as $plataformita){
                                if($plataformita['id'] == $productito['plataforma']){
                                    echo $plataformita['nombre']. "<br />"; } } ?></p>
                            <a href=#stophere>
                                <p class="listadoprecio"><img src="imagenes/iconos/iconocomprablanco.png" alt="Icono compra blanco" width="25" height="25" class="img-fluid float-left"><?php echo "$".$productito['precio'] . "<br />"; ?></p>
                            </a>
                            </div>
                        </article>
                    </div>
                    
                    <?php 
                    }                    
                    if(!$hayProductos){
                        echo '<img src="imagenes/no-products-found.png" alt="No hay productos" width="260" height="344" class="img-fluid"/>';
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
