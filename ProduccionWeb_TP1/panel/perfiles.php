<?php
require('inc/header.php');
?>

<div class="container-fluid">

	<?php $perfilMenu = 'Perfiles';

	$perfiles = new Perfil($con);
	include('inc/side_bar.php');

	if (isset($_POST['formulario_perfiles'])) {
		if ($_POST['id'] > 0) {
			$perfiles->edit($_POST);
		} else {

			$perfiles->save($_POST);
		}
		header('Location: perfiles.php');
	}

	if(isset($_GET['modif'], $_GET['id'])){
		$perfiles->update($_GET['modif'], $_GET['id']);
		header('Location: perfiles.php');	
	}

	if (isset($_GET['del'])) {
		$resp = $perfiles->del($_GET['del']);
		if ($resp == 1) {
			header('Location: perfiles.php');
		}
		echo '<script>alert("' . $resp . '");</script>';
	}
	?>

	<div class="col-sm-9 col-md-10 main">

		<!--toggle sidebar button-->
		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>

		<h1 class="page-header">
			Perfiles
		</h1>

		<?php if (in_array('prod.add', $_SESSION['usuario']['permisos']['cod'])) { ?>
			<a href="perfiles_ae.php"><button type="button" class="btn btn-success" title="Agregar">Alta de perfil</button></a>
		<?php } ?>
		
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Permisos asignados</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($perfiles->getList() as $perfil) { ?>

						<tr>
							<td><?php echo $perfil['id']; ?></td>
							<td><?php echo $perfil['nombre']; ?></td>
							<td><?php 
								$haypermis = false;
								foreach ($perfiles->getPermisos($perfil['id']) as $permis) {
									$haypermis = true;
									echo $permis['nombre'];
									?> <br> <?php
								}
								if(!$haypermis){
									echo "No hay permisos asignados";
								}
								?></td>				
							<td><?php if($perfil['estado'] == 1){
								echo 'Activo';
							} else {
								echo 'Inactivo';
							} 	?></td>
							<td>
								<?php if (in_array('per.edit', $_SESSION['usuario']['permisos']['cod'])) { ?>
									<a href="perfiles_ae.php?edit=<?php echo $perfil['id'] ?>"><button type="button" class="btn btn-info" title="Modificar">M</button></a>
								<?php } ?>

								<?php if (in_array('per.act', $_SESSION['usuario']['permisos']['cod'])) { ?>
									<?php if($perfil['estado'] == 0){ ?>
										<a href="perfiles.php?modif=<?php echo $perfil['estado'] ?>&id=<?php echo $perfil['id']?>"><button type="button" class="btn btn-success" title="Activar">A</button></a>
									<?php } else { ?>
										<a href="perfiles.php?modif=<?php echo $perfil['estado'] ?>&id=<?php echo $perfil['id']?>"><button type="button" class="btn btn-warning" title="Desactivar">D</button></a>
									<?php } ?>
								<?php } ?>

								<?php if (in_array('per.del', $_SESSION['usuario']['permisos']['cod'])) { ?>
									<a href="perfiles.php?del=<?php echo $perfil['id'] ?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
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