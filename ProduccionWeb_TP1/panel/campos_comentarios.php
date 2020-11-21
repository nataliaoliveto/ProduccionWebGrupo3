<?php
require('inc/header.php');
?>

<div class="container-fluid">

	<?php $campoComentarioMenu = 'Campos Comentarios';
	$comen = new Campo_comentario($con);
	include('inc/side_bar.php');

	if(isset($_GET['modif'], $_GET['id'])){
		$comen->update($_GET['modif'], $_GET['id']);
		header('Location: campos_comentarios.php');	
	}

	if (isset($_POST['submit'])) {
		if ($_POST['id_din'] > 0) {
			$comen->edit($_POST); //Marcos haz lo tuyo
		} else {
			$comen->save($_POST);
		}

		header('Location: campos_comentarios.php');
	}

	if (isset($_GET['del'])) { //Marcos haz lo tuyo
		$resp = $comen->del($_GET['del']);
		if ($resp == 1) {
			header('Location: campos_comentarios.php');
		}
		echo '<script>alert("' . $resp . '");</script>';
	}

	?>

	<div class="col-sm-9 col-md-10 main">
		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>

		<h1 class="page-header">
			<?php echo $campoComentarioMenu ?>
		</h1>

		<a href="comentarios_ae.php"><button type="button" class="btn btn-success" title="Agregar">Alta de Campo Comentario</button></a>

		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Label</th>
						<th>Type</th>
						<th>Opciones</th>
						<th>Requerido</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>

				<tbody>
					<?php 
					foreach ($comen->getList() as $comentarios) { ?>
						<tr>
						<td><?php echo $comentarios['id_din'];?></td>
						<td><?php echo $comentarios['label'];?></td>
						<td><?php echo $comentarios['type'];?></td>
						<td><?php echo $comentarios['opcion'];?></td>
						<td><?php if($comentarios['required'] == 1){
							echo 'Sí';
						} else {
							echo 'No';
						} 	?></td>
						<td>
						<td><?php if($comentarios['estado'] == 1){
							echo 'Activa';
						} else {
							echo 'Inactiva';
						} 	?></td>
						<td>
						<a href="comentarios_ae.php?edit=<?php echo $comentarios['id_din']?>"><button type="button" class="btn btn-info" title="Modificar nombre">M</button></a>
							<?php if($comentarios['estado'] == 0){ ?>
								<a href="campos_comentarios.php?modif=<?php echo $comentarios['estado'] ?>&id=<?php echo $comentarios['id_din']?>"><button type="button" class="btn btn-success" title="Activar">A</button></a>
							<?php } else { ?>
								<a href="campos_comentarios.php?modif=<?php echo $comentarios['estado'] ?>&id=<?php echo $comentarios['id_din']?>"><button type="button" class="btn btn-warning" title="Desactivar">D</button></a>
							<?php } ?>
							<a href="campos_comentarios.php?del=<?php echo $comentarios['id_din'] ?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
						</td>
						</tr>
					<?php } ?> 
				</tbody>

			</table>
		</div>

	</div>
</div>

<?php include('inc/footer.php'); ?>