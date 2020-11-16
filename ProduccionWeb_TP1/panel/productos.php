<?php
require('inc/filtro.php');
?>

<div class="container-fluid">

<?php $productoMenu = 'Productos';
include('inc/side_bar.php');

if (isset($_POST['formulario_productos'])) {
if ($_POST['id'] > 0) {
	$produ->edit($_POST);
} else {
	$produ->save($_POST);
}
header('Location: productos.php');
}

if (isset($_GET['modif'], $_GET['id'])) {
$produ->update($_GET['modif'], $_GET['id']);
header('Location: productos.php');
}

if (isset($_GET['del'])) {
$resp = $produ->del($_GET['del']);
if ($resp == 1) {
	header('Location: productos.php');
}
echo '<script>alert("' . $resp . '");</script>';
}

?>

<div class="col-sm-9 col-md-10 main">

<p class="visible-xs">
	<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
</p>

<h1 class="page-header">
	<?php echo $productoMenu ?>
</h1>

<a href="productos_ae.php"><button type="button" class="btn btn-success" title="Agregar">Alta de producto</button></a>

<!-- filtro -->
<div class="btn-group">
	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $lblBtnGeneros ?>
	</button>
	<div class="dropdown-menu">
		<?php
		foreach ($produ->getGeneros() as $generos) {
		?>
			<a class="dropdown-item" href="productos.php?generos=<?php echo $generos['id'] ?>&edades=">
				<?php echo $generos['nombre']; ?>
			</a>
		<?php
		}
		?>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="productos.php?generos=&edades=">Eliminar filtro</a>
	</div>
</div>
<div class="btn-group">
	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $lblBtnEdades ?>
	</button>
	<div class="dropdown-menu">
		<?php
		if ($generoID != '') {
			foreach ($produ->getGeneroEdades($generoID) as $genEdad) {
				foreach ($produ->getEdadNombre($genEdad['idedad']) as $edad) {
		?>
					<a class="dropdown-item" href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo $edad['id'] ?>">
						<?php echo $edad['nombre']; ?>
					</a>
		<?php
				}
			}
		}
		?>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=">Eliminar filtro</a>
	</div>
</div>
<!-- fin filtro -->
	
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Plataforma</th>
				<th>Género</th>
				<th>Edad</th>
				<th>Descripción</th>
				<th>Estado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$genID = empty($_GET['generos']) ? 0 : $_GET['generos'];
			$edadID = empty($_GET['edades']) ? 0 : $_GET['edades'];	
			foreach ($produ->getList($genID, $edadID) as $productos) { ?>

				<tr>
					<td><?php echo $productos['id']; ?></td>
					<td><?php echo $productos['nombre']; ?></td>
					<td><?php echo $productos['precio']; ?></td>
					<td><?php
						foreach ($produ->getPlataforma($productos['plataforma']) as $nombre) {
							echo $nombre['nombre'];
						} ?></td>
					<td><?php
						foreach ($produ->getGenero($productos['genero']) as $nombre) {
							echo $nombre['nombre'];
						} ?></td>
					<td><?php
						foreach ($produ->getEdad($productos['edad']) as $nombre) {
							echo ucfirst(substr($nombre['nombre'], 0, 7));
						} ?></td>
					<td><?php echo ucfirst(substr($productos['descripcion'], 0, 200)) . '...'; ?></td>
					<td><?php if ($productos['estado'] == 1) {
							echo 'Activo';
						} else {
							echo 'Inactivo';
						} 	?></td>
					<td>
						<a href="productos_ae.php?edit=<?php echo $productos['id'] ?>"><button type="button" class="btn btn-info" title="Modificar">M</button></a>
						<?php if ($productos['estado'] == 0) { ?>
							<a href="productos.php?modif=<?php echo $productos['estado'] ?>&id=<?php echo $productos['id'] ?>"><button type="button" class="btn btn-success" title="Activar">A</button></a>
						<?php } else { ?>
							<a href="productos.php?modif=<?php echo $productos['estado'] ?>&id=<?php echo $productos['id'] ?>"><button type="button" class="btn btn-warning" title="Desactivar">D</button></a>
						<?php } ?>
						<a href="productos.php?del=<?php echo $productos['id'] ?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</div>
</div>
</div>

<?php include('inc/footer.php'); ?>