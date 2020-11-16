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
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo (isset($productito->nombre) ? $productito->nombre : ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="tipo" class="col-sm-2 control-label">Permisos</label>
                <div class="col-sm-10">
                    <select name="permisos[]" id="permisos" multiple='multiple'>
                        <?php foreach ($permisos as $t) { ?>
                            <option value="<?php echo $t['id'] ?>" 
                            <?php
                            if (isset($productito->permisos)) {
                                if (in_array($t['id'], $productito->permisos)) {
                                    echo ' selected="selected" ';
                                }
                            }
                        ?>><?php echo $t['nombre'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="" value="<?php echo (isset($productito->descripcion) ? $productito->descripcion : ''); ?>">
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

<!-- nombre, descripcion, precio, plataforma, género, edad
<?php include('inc/footer.php'); ?>