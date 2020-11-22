<?php
require('inc/header.php');
?>

<div class="container-fluid">

    <?php $generoMenu = 'Géneros';
	$gen = new Genero($con);
	include('inc/side_bar.php');

    if (isset($_GET['edit'])) {
        $generitos = $gen->get($_GET['edit']);
    } 

    ?>

    <div class="col-sm-9 col-md-10 main">
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            Modificar Género
        </h1>

        <div class="col-md-2"></div>
        <form action="generos.php" method="post" class="col-md-6 from-horizontal">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="name" value="<?php echo (isset($generitos->nombre) ? $generitos->nombre : ''); ?> " required>
                </div>
            </div>
            
            <div class="form-group">
                    <label for="tipo" class="col-sm-2 control-label">Edades</label>
                    <div class="col-sm-10">
                        <select name="edades[]" id="edades" multiple='multiple' >
                            <?php  foreach($gen->getEdades() as $e){?>
                                <option value="<?php echo $e['id']?>"
                                <?php 
                                    foreach ($gen->selEdad($generitos->id) as $subcat) {
                                        if($subcat['idedad'] == $e['id']){
                                            echo ' selected="selected" ';
                                        }
                                    }
								?>><?php echo $e['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
            </div> 

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" class="input-xlarge" name="id" value="<?php echo $_GET['edit'] ?>"/> 
                    <button type="submit" class="btn btn-default" name="formulario_generos">Guardar</button>
                </div>
            </div>
            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo (isset($generitos->id) ? $generitos->id : ''); ?>">

        </form>
    </div>
</div>
</div>
</div>

<?php include('inc/footer.php'); ?>