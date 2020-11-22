<?php
require('inc/header.php');
?>

<div class="container-fluid">

    <?php $comentarioMenu = 'Campos Comentarios';
    include('inc/side_bar.php');

    $comen = new Campo_comentario($con);
    $lblTitulo = "Nuevo Campo Comentario";
    if (isset($_GET['edit'])) {
        $comentarito = $comen->get($_GET['edit']);
        $lblTitulo = "Modificar Campo Comentario";
    }
    ?>

<div class="col-sm-9 col-md-10 main">

        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            <?php echo $lblTitulo ?>
        </h1>

        <div class="col-md-2"></div>
        <form action="campos_comentarios.php" method="post" class="col-md-6 from-horizontal">
        <div class="form-group">
                <label for="label" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Label</label>
                <div class="col-sm-10">                                        
                    <input type="text" class="form-control" id="label" name="label" placeholder="" value="<?php echo (isset($comentarito->label) ? $comentarito->label : ''); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="type" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Type</label>
                <div class="col-md-6">      
                    <select id="type" name="type" onchange="onTypeChange()">
                        <option value = checkbox >Checkbox</option>
                        <option value = text <?php echo(isset($comentarito->type) ? (($comentarito->type == 'text') ? 'selected' : '') : '');?>>Text</option>
                        <option value = option <?php echo(isset($comentarito->type) ? (($comentarito->type == 'option') ? 'selected' : '') : '');?>>Option</option>
                    </select>                        
                </div>
            </div> 

            <div class="form-group" id="opcion-form-group">
                <label for="opcion" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">Opcion (separar con | )</label>
                <div class="col-sm-10">                                        
                    <input type="text" class="form-control" id="opcion" name="opcion" placeholder="" value="<?php echo (isset($comentarito->opcion) ? $comentarito->opcion : ''); ?>">
                </div>
            </div>
            
            <input type="hidden" name="required" id="required" value= 0 <?php echo (isset($comentarito->required) ? (($comentarito->required == 0) ? '' : 'checked') : '');?>>
            <input type="checkbox" name="required" id="required" value= 1 <?php echo (isset($comentarito->required) ? (($comentarito->required == 1) ? 'checked' : '') : '');?>>

            <div class="form-group">
                <div class="col-sm-offset-2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="submit" class="btn btn-default" name="submit">Guardar</button>
                </div>
            </div>
            <input type="hidden" class="form-control" id="id_din" name="id_din" placeholder="" value="<?php echo isset($comentarito->id_din) ? $comentarito->id_din : ''; ?>">

        </form>
    </div>
</div>

<script>
    var fieldWithOptions = ["option"];
    function onTypeChange() {
        var seleccionado = document.getElementById("type").value;
        var opcionFormGroup = document.getElementById("opcion-form-group");
        var opcionInput = document.getElementById("opcion");
        //var hasOptions = false;
        //si el campo no puede tener opciones, agregar null desde el lado servidor
        for(var i = 0; i < fieldWithOptions.length; i++){
            if (seleccionado == fieldWithOptions[i]){
                //hasOptions = true;
                opcionFormGroup.style.display="block";
                break;
            }else{
                opcionFormGroup.style.display="none";
            }
        }

        /*if (hasOptions){
            opcionFormGroup.style.display="block";
        }else{
            opcionInput.value = "NULL";
            opcionFormGroup.style.display="none";
        }*/
    }
    onTypeChange();
</script>

<?php include('inc/footer.php'); ?>