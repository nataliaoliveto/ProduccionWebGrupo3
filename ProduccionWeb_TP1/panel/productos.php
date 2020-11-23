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
header('Location: productos.php?pagina=1');
}

if (isset($_GET['modif'], $_GET['id'], $_GET['generos'], $_GET['edades'])) {
	$produ->update($_GET['modif'], $_GET['id']);
	$genero = isset($_GET['generos']) ? $_GET['generos'] : '';
	$plataforma = isset($_GET['edades']) ? $_GET['edades'] : '';
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : '';
	header('Location: productos.php?&generos='.$genero.'&edades='.$plataforma.'&pagina='.$pagina);
}

if (isset($_GET['del'], $_GET['generos'], $_GET['edades'])) {
	$produ->del($_GET['del']);
	$genero = isset($_GET['generos']) ? $_GET['generos'] : '';
	$plataforma = isset($_GET['edades']) ? $_GET['edades'] : '';
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : '';
	header('Location: productos.php?&generos='.$genero.'&edades='.$plataforma.'&pagina='.$pagina);
}



?>

<div class="col-sm-9 col-md-10 main">

<p class="visible-xs">
	<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
</p>

<h1 class="page-header">
	<?php echo $productoMenu ?>
</h1>
<?php if (in_array('prod.add', $_SESSION['usuario']['permisos']['cod'])) { ?>
	<a href="productos_ae.php"><button type="button" class="btn btn-success" title="Agregar">Alta de producto</button></a>
<?php } ?>

<!-- filtro -->
<div class="btn-group">
	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $lblBtnGeneros ?>
	</button>
	<div class="dropdown-menu">
		<?php
		foreach ($produ->getGeneros() as $generos) {
		?>
			<a class="dropdown-item" href="productos.php?generos=<?php echo $generos['id'] ?>&edades=&pagina=1">
				<?php echo $generos['nombre']; ?>
			</a>
		<?php
		}
		?>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="productos.php?generos=&edades=&pagina=1">Eliminar filtro</a>
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
					<a class="dropdown-item" href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo $edad['id'] ?>&pagina=1">
						<?php echo $edad['nombre']; ?>
					</a>
		<?php
				}
			}
		}
		?>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=&pagina=1">Eliminar filtro</a>
	</div>
</div>
<!-- fin filtro -->

<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
<a href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>&pagina=1"><button type="button" class="btn btn-warning" title="Primera">|<-</button></a>
<a href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>&pagina=<?php echo(($_GET['pagina'] != 1) ? ($_GET['pagina'] - 1) : $_GET['pagina']); ?>"><button type="button" class="btn btn-warning" title="Anterior"><</button></a>

<div class="btn-group">
	<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $_GET['pagina'] ?>
	</button>
		<?php
		$generito = empty($_GET['generos']) ? 0 : $_GET['generos'];
		$edadmini = empty($_GET['edades']) ? 0 : $_GET['edades']; 
		$paginado = $produ->getPaginas($generito, $edadmini);?>
		<div class="dropdown-menu">
		<?php 
			for($i = 1; $i <= $paginado; $i++){ ?>
			<a class="dropdown-item" href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>&pagina=<?php echo $i ?>">
			<?php 		
			echo $i; ?> </a>
		<?php }?>
		</div>
</div>

<a href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>&pagina=<?php echo(($_GET['pagina'] != $paginado ) ? ($_GET['pagina'] + 1) : $_GET['pagina'])?>"><button type="button" class="btn btn-warning" title="Siguiente">></button></a>
<a href="productos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>&pagina=<?php echo $paginado ?>"><button type="button" class="btn btn-warning" title="Última">->|</button></a>
</div>

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
				<th>Estado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$genID = empty($_GET['generos']) ? 0 : $_GET['generos'];
			$edadID = empty($_GET['edades']) ? 0 : $_GET['edades'];	
			$pagina = empty($_GET['pagina']) ? 0 : $_GET['pagina'];
			foreach ($produ->getList($genID, $edadID, $pagina) as $productos) { ?>

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
					<td><?php if ($productos['estado'] == 1) {
							echo 'Activo';
						} else {
							echo 'Inactivo';
						} 	?></td>
					<td>
						<?php if (in_array('prod.edit', $_SESSION['usuario']['permisos']['cod'])) { ?>
							<a href="productos_ae.php?edit=<?php echo $productos['id'] ?>"><button type="button" class="btn btn-info" title="Modificar">M</button></a> 
						<?php } ?>
						
						<?php if (in_array('prod.act', $_SESSION['usuario']['permisos']['cod'])) { ?>
							<?php if ($productos['estado'] == 0) { ?>
								<a href="productos.php?modif=<?php echo $productos['estado'] ?>&id=<?php echo $productos['id'] ?>&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>&pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : '' ?>"><button type="button" class="btn btn-success" title="Activar">A</button></a>
							<?php } else { ?>
								<a href="productos.php?modif=<?php echo $productos['estado'] ?>&id=<?php echo $productos['id'] ?>&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>&pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : '' ?>"><button type="button" class="btn btn-warning" title="Desactivar">D</button></a>
							<?php } ?>
						<?php } ?>
						
						<?php if (in_array('prod.del', $_SESSION['usuario']['permisos']['cod'])) { ?>
							<a href="productos.php?del=<?php echo $productos['id'] ?>&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>&pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : '' ?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
						<?php } ?>

						<?php if (in_array('prod.ver', $_SESSION['usuario']['permisos']['cod'])) { ?>
							<?php $countComentarios = $produ->getCountComentarios($productos['id']);
								if ($countComentarios > 0) { ?>
									<a href="comentarios.php?estado=2&pagina=1&idprod=<?php echo $productos['id'] ?>"><button type="button" class="btn btn-info" title="Comentarios">C</button></a> 
							<?php } else { ?>
								<button type="button" class="btn btn-info" title="Comentarios" disabled>C</button></a> 
							<?php } ?>
						<?php } ?>																								
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