<?php
require('inc/header.php');
?>

<div class="container-fluid">

	<?php $plataformaMenu = 'Plataformas';
	$plata = new Plataforma($con);
	include('inc/side_bar.php');

	if(isset($_GET['modif'], $_GET['id'])){
		$plata->update($_GET['modif'], $_GET['id']);
		header('Location: plataformas.php');	
	}

	if(isset($_POST['formulario_plataformas'])){ 
		$plata->edit($_POST); 
		//$id, $nombre
	} 

	$mensaje = false;
	if(isset($_POST['alta_plataformas'])){
		if($plata->save($_POST) == 1){
			$mensaje = true;
		} 
	}

	if (isset($_GET['del'])) {
		$resp = $plata->del($_GET['del']);
		if ($resp == 1) {
			header('Location: plataformas.php');
		}
		echo '<script>alert("' . $resp . '");</script>';
	}

	?>

	<div class="col-sm-9 col-md-10 main">
		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>

		<h1 class="page-header">
			<?php echo $plataformaMenu ?>
		</h1>

		<div class="container-fluid">
			<?php if (in_array('pla.add', $_SESSION['usuario']['permisos']['cod'])) { ?>
				<form action="plataformas.php" method="post" class="navbar-form navbar-left">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nueva plataforma" required> 
					<button type="submit" class="btn btn-success" name="alta_plataformas" title="Agregar">Nueva Plataforma</button></a>
					<?php if ($mensaje) {
						?>  <p id="errorComentario"> Error al cargar plataforma: nombre existente </p>
					<?php } ?>
				</form>
			<?php } ?>			
		</div>

		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>

				<tbody>
					<?php 
					foreach ($plata->getList() as $plataformas) { ?>
						<tr>
						<td><?php echo $plataformas['id'];?></td>
						<td><?php echo $plataformas['nombre'];?></td>
						<td><?php if($plataformas['estado'] == 1){
							echo 'Activa';
						} else {
							echo 'Inactiva';
						} 	?></td>
						<td>
							<?php if (in_array('pla.edit', $_SESSION['usuario']['permisos']['cod'])) { ?>
								<a href="plataformas_ae.php?edit=<?php echo $plataformas['id']?>"><button type="button" class="btn btn-info" title="Modificar nombre">M</button></a>
							<?php } ?>

							<?php if (in_array('pla.act', $_SESSION['usuario']['permisos']['cod'])) { ?>
								<?php if($plataformas['estado'] == 0){ ?>
									<a href="plataformas.php?modif=<?php echo $plataformas['estado'] ?>&id=<?php echo $plataformas['id']?>"><button type="button" class="btn btn-success" title="Activar">A</button></a>
								<?php } else { ?>
									<a href="plataformas.php?modif=<?php echo $plataformas['estado'] ?>&id=<?php echo $plataformas['id']?>"><button type="button" class="btn btn-warning" title="Desactivar">D</button></a>
								<?php } ?>
							<?php } ?>
							
							<?php if (in_array('pla.del', $_SESSION['usuario']['permisos']['cod'])) { ?>
								<a href="plataformas.php?del=<?php echo $plataformas['id'] ?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
							<?php } ?>														
						</td>
						</tr>
					<?php } ?> 
				</tbody>

			</table>
		</div>

	</div>
</div>

<?php include('inc/footer.php'); ?>