<?php
require('inc/header.php');
?>

<div class="container-fluid">

    <?php $plataformaMenu = 'Plataformas';
    $plata = new Plataforma($con);
    include('inc/side_bar.php');

    $query = 'SELECT * FROM permisos';
    $permisos = $con->query($query);

    if (isset($_GET['edit'])) {
        $plataformitas = $plata->get($_GET['edit']);
    }

    ?>

    <div class="col-sm-9 col-md-10 main">
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            Modificar Plataforma
        </h1>

        <div class="col-md-2"></div>
        <form action="plataformas.php" method="post" class="col-md-6 from-horizontal">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="name" value="<?php echo (isset($plataformitas->nombre) ? $plataformitas->nombre : ''); ?> " required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" class="input-xlarge" name="id" value="<?php echo $_GET['edit'] ?>"/> 
                    <button type="submit" class="btn btn-default" name="formulario_plataformas">Guardar</button>
                </div>
            </div>
            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo (isset($plataformitas->id) ? $plataformitas->id : ''); ?>">

        </form>
    </div>
</div>
</div>
</div>

<?php include('inc/footer.php'); ?>