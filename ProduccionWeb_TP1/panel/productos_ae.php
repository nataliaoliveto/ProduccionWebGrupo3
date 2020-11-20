<?php
require('inc/header.php');
?>

<div class="container-fluid">

    <?php $productoMenu = 'Productos';
    include('inc/side_bar.php');

    $produ = new Producto($con);

    $query = 'SELECT * FROM permisos';
    $permisos = $con->query($query);
    // var_dump($permisos);

    if (isset($_GET['edit'])) {
        $productito = $produ->get($_GET['edit']);
        //var_dump($productito);
    }
    ?>

    <div class="col-sm-9 col-md-10 main">

        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            Nuevo Producto
        </h1>

        <div class="col-md-2"></div>
        <form action="productos.php" method="post" class="col-md-6 from-horizontal">
            <div class="form-group">
                <label for="nombre" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo (isset($productito->nombre) ? $productito->nombre : ''); ?>">
                </div>
            </div>          
            
            <div class="form-group">
                <label for="descripcion" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Descripción</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="" value="<?php echo (isset($productito->descripcion) ? $productito->descripcion : ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Precio $</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" id="precio" name="precio" placeholder="" value="<?php echo (isset($productito->precio) ? $productito->precio : ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="nombre" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Destacado</label>                
                <div class="col-sm-10">                    
                    <select id="destacado" name="destacado">
                        <option value = 0>No</option>                                                
                        <option value = 1 <?php echo(isset($productito->destacado) ? (($productito->destacado == 1) ? 'selected' : '') : '');?>>Si</option>                        
                    </select>                  
                </div>
            </div>          
            
            <div class="form-group">
                <label for="descripcion" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Stock</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" id="Stock" name="Stock" placeholder="" value="<?php echo (isset($productito->stock) ? $productito->stock : ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Desarrollador</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" id="desarrolador" name="desarrollador" placeholder="" value="<?php echo (isset($productito->desarrollador) ? $productito->desarrollador : ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Fecha de Lanzamiento</label>
                <div class="col-sm-10">                    
                    <input type="date" class="form-control" id="fechadelanzamiento" name="fechadelanzamiento" placeholder="" value="<?php echo (isset($productito->fechadelanzamiento) ? $productito->fechadelanzamiento : ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Plataforma</label>
                <div class="col-sm-10">      
                    <select id="plataforma" name="plataforma">
                        <?php
                            foreach ($produ->getPlataformas() as $plataformita) { ?>
                            <option value = "<?php echo $plataformita['id'];?>"<?php echo(isset($productito->plataforma) ? (($productito->plataforma == $plataformita['id']) ? 'selected' : '') : '');?>> <?php echo $plataformita['nombre'];?></option>
                        <?php } ?>                                
                    </select>                        
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Género</label>
                <div class="col-sm-10">      
                    <select id="genero" name="genero" onchange="onGeneroChange()">
                        <?php
                            foreach ($produ->getGeneros() as $generito) { ?>
                            <option value = "<?php echo $generito['id'];?>"<?php echo(isset($productito->genero) ? (($productito->genero == $generito['id']) ? 'selected' : '') : '');?>> <?php echo $generito['nombre'];?></option>
                        <?php } ?>                                
                    </select>                        
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="formulario_productos">Guardar</button>
                </div>
            </div>
            
            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo (isset($productito->id) ? $productito->id : ''); ?>">

        </form>
    </div>
</div>
</div>
</div>

<script>
    var productoEdad = <?php echo $productito->edad; ?>;
    var edadesData = <?php echo json_encode($produ->getEdades()->fetchAll(), JSON_HEX_TAG); ?>;
    var generosEdadesData = <?php echo json_encode($produ->getGeneroEdadesTotal()->fetchAll(), JSON_HEX_TAG); ?>;
            
    console.log(productoEdad);
    generosEdadesData.sort(function(a, b) {
        if(a.nombre < b.nombre) { return -1; }
        if(a.nombre > b.nombre) { return 1; }
        return 0;
    });

    function onGeneroChange() {
        var seleccionado = document.getElementById("genero").value;
        var edadSelect = document.getElementById("edad");
    
        for (i = edadSelect.options.length; i >= 0 ; i--) {
            edadSelect.remove(i);
        }
        
        for (var i = 0; i < generosEdadesData.length; i++) {
            if(generosEdadesData[i].idgen == seleccionado){
                var newOption = document.createElement('option');
                newOption.text = getEdadNombre(generosEdadesData[i].idedad);
                newOption.value = generosEdadesData[i].idedad;
                if(newOption.value == productoEdad){
                    newOption.selected = true;
                }
                edadSelect.add(newOption);  
            }
        }
    }

    function getEdadNombre(edadID){
        for (var i = 0; i < edadesData.length; i++) {
            if(edadesData[i].id == edadID){
                return edadesData[i].nombre;
            }
        }
    }
    onGeneroChange();

</script>

<?php include('inc/footer.php'); ?>