<?php
require('inc/header.php');
?>

<div class="container-fluid">

    <?php $productoMenu = 'Productos';
    include('inc/side_bar.php');

    $produ = new Producto($con);

    $query = 'SELECT * FROM campos_dinamicos WHERE estado = 1';
    $campos_din = $con->query($query);
    $lblTitulo = "Nuevo Producto";
    if (isset($_GET['edit'])) {
        $productito = $produ->get($_GET['edit']);
        $lblTitulo = "Modificar Producto";
    }

    ?>

    <div class="col-md-9 main">

        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            <?php echo $lblTitulo ?>
        </h1>

        <div class="col-md-12">
        <form action="productos.php" method="post" class="col-sm-12 from-horizontal"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo (isset($productito->nombre) ? $productito->nombre : ''); ?>" required>
                </div>
            </div>          
            
            <div class="form-group">
                <label for="descripcion" class="col-sm-12 control-label">Descripción</label>
                <div class="col-sm-10">                                        
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="" value="<?php echo (isset($productito->descripcion) ? $productito->descripcion : ''); ?>" required>
                </div>
            </div>

            <div class="form-group">
            <div class="checkbox">
                <label for="destacado" class="col-sm-3 control-label">Destacado</label>                
                <div class="col-sm-9">                    
                <input type="hidden" name="destacado" id="destacado" value= 0 <?php echo (isset($productito->destacado) ? (($productito->destacado == 0) ? '' : 'checked') : '');?>>
                <input type="checkbox" name="destacado" id="destacado" value= 1 <?php echo (isset($productito->destacado) ? (($productito->destacado == 1) ? 'checked' : '') : '');?>>
            </div></div>
            </div> 

            <div class="form-group">
                <label for="plataforma" class="col-sm-12 control-label">Plataforma</label>
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
                <label for="genero" class="col-sm-12 control-label">Género</label>
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
                <label for="edad" class="col-sm-12 control-label">Edad</label>
                <div class="col-sm-10">      
                    <select id="edad" name="edad">
                    <!-- Magia JavaScript -->
                    </select>                        
                </div>
            </div>

            <div class="form-group">
                <label for="desarrolador" class="col-sm-12 control-label">Desarrollador</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" id="desarrolador" name="desarrollador" placeholder="" value="<?php echo (isset($productito->desarrollador) ? $productito->desarrollador : ''); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="fechadelanzamiento" class="col-sm-12 control-label">Fecha de Lanzamiento</label>
                <div class="col-sm-10">                    
                    <input type="date" class="form-control" id="fechadelanzamiento" name="fechadelanzamiento" placeholder="" value="<?php echo (isset($productito->fechadelanzamiento) ? $productito->fechadelanzamiento : ''); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="precio" class="col-sm-12 control-label">Precio ($)</label>
                <div class="col-sm-10">                    
                    <input type="number" class="form-control" id="precio" name="precio" placeholder="" value="<?php echo (isset($productito->precio) ? $productito->precio : ''); ?>" required>
                </div>
            </div>                  
            
            <div class="form-group">
                <label for="Stock" class="col-sm-12 control-label">Stock</label>
                <div class="col-sm-10">                    
                    <input type="number" class="form-control" id="Stock" name="Stock" placeholder="" value="<?php echo (isset($productito->stock) ? $productito->stock : ''); ?>" required>
                </div>
            </div>     
            
            <div class="form-group">
                <label for="tipo" class="col-sm-12 control-label">Comentarios Dinámicos</label>
                <div class="col-sm-10">
                    <select name="campos_din[]" id="campos_din" multiple='multiple'>
                        <?php foreach ($campos_din as $cd) { ?>
                            <option value="<?php echo $cd['id_din'] ?>" 
                            <?php
                            if (isset($productito->prod_din)) {
                                if (in_array($cd['id_din'], $productito->prod_din)) {
                                    echo ' selected="selected" ';
                                }
                            }
                        ?>><?php echo $cd['label'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
            <label for="tipo" class="col-sm-12 control-label">Información Extra</label>
            <div class="col-sm-10">
            <table class="table">
            <input type="text" id="produ_extra_label" placeholder="Label">
            <input type="text" id="produ_extra_texto" placeholder="Texto">
            <input type="button" class="add-row" value="Add Row">
                <thead>
                    <tr>
                        <th scope="col">Select</th>
                        <th scope="col">Label</th>
                        <th scope="col">Texto</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Magia jQuery -->
                    <?php if (isset($_GET['edit'])) {
                    foreach ($produ->getProducto_extra_info($_GET['edit']) as $pei) { ?>
                        <tr><td><input type="checkbox" name="record"></td>
                        <td><input name="produ_extra_label[]" value="<?php echo (isset($pei['label']) ? $pei['label'] : '')?>"></td>
                        <td><input name="produ_extra_texto[]" value="<?php echo (isset($pei['texto']) ? $pei['texto'] : '')?>"></td>
                        </tr> 
                    <?php } }
                    ?>
                </tbody>
            </table>
            <button type="button" class="delete-row">Delete Row</button>
            </div>
            </div>
            

            <div class="form-group">
                <label for="imagen" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Carátula</label>
                <div class="col-sm-10">      
                    <input type="file" name="imagen">
                </div>
            </div>

            <div class="form-group"> 
                <label for="imagen" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Carousel</label>
                <div class="col-sm-10">      
                <input type="file" name="caro[]" multiple title="caro">
                </div>
            </div>
        
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="formulario_productos">Guardar</button>
                </div>
            </div>
            </div>
            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo (isset($productito->id) ? $productito->id : ''); ?>">
        </form>
        </div>
    </div>
</div>

<!-- Magia JavaScript -->
<?php include('inc/footer.php'); ?>
<script>
    var productoEdad = <?php echo (isset($productito->edad) ? $productito->edad : 0); ?>;
    var edadesData = <?php echo json_encode($produ->getEdades()->fetchAll(), JSON_HEX_TAG); ?>;
    var generosEdadesData = <?php echo json_encode($produ->getGeneroEdadesTotal()->fetchAll(), JSON_HEX_TAG); ?>;

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
    
                    
    $(document).ready(function(){
        $(".add-row").click(function(){
            var label = $("#produ_extra_label").val();
            var texto = $("#produ_extra_texto").val();
            if(label == '' || texto == ''){ return; }
            var markup = '<tr><td><input type="checkbox" name="record"></td><td><input name="produ_extra_label[]" value="'+label+'"></td><td><input name="produ_extra_texto[]" value="'+texto+'"></td></tr>';
            $("table tbody").append(markup);
            $("#produ_extra_label").val('');
            $("#produ_extra_texto").val('');
        });
        
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    }); 

</script>


