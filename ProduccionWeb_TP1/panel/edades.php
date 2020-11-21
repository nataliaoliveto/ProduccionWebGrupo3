<?php
require('inc/header.php');
?>

<div class="container-fluid">

	<?php $edadMenu = 'Edades';
	$edad = new Edad($con);
	include('inc/side_bar.php');

	if(isset($_GET['modif'], $_GET['id'])){
		$edad->update($_GET['modif'], $_GET['id']);
		header('Location: edades.php');	
	}

	if(isset($_POST['formulario_edades'])){ 
		$edad->edit($_POST); 
	} 

	$mensaje = false;
	if(isset($_POST['alta_edades'])){
		if($edad->save($_POST) == 1){
			$mensaje = true;
		} 
	}
	
	if (isset($_GET['del'])) {
		$resp = $edad->del($_GET['del']);
		if ($resp == 1) {
			header('Location: edades.php');
		}
		echo '<script>alert("' . $resp . '");</script>';
	}

	?>

	<div class="col-sm-9 col-md-10 main">
		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>

		<h1 class="page-header">
			<?php echo $edadMenu ?>
		</h1>

		<div class="container-fluid">

			<form action="edades.php" method="post" class="navbar-form navbar-left">
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nueva edad" required> 
				<button type="submit" class="btn btn-success" name="alta_edades" title="Agregar">Nueva Edad</button></a>
				<?php if ($mensaje) {
				?>  <p id="errorComentario"> Error al cargar edad: nombre existente </p>
				<?php } ?>
			</form>
		</div>

		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Estado</th>
						<th>Géneros relacionados</th>
						<th>Acciones</th>
					</tr>
				</thead>

				<tbody>
					<?php 
					foreach ($edad->getList() as $edades) { ?>
						<tr>
						<td><?php echo $edades['id'];?></td>
						<td><?php echo $edades['nombre'];?></td>
						<td><?php if($edades['estado'] == 1){
							echo 'Activa';
						} else {
							echo 'Inactiva';
						} 	?></td>	
						<td> <?php 
						$haycat = false;
						foreach ($edad->getCategoria($edades['id']) as $cate) {
									$haycat = true;
									echo $cate['nombre'];
									?> <br> <?php
								}
								if(!$haycat){
									echo "No hay géneros relacionados";
								} ?></td>
						<td>
						<a href="edades_ae.php?edit=<?php echo $edades['id']?>"><button type="button" class="btn btn-info" title="Modificar nombre">M</button></a>
							<?php if($edades['estado'] == 0){ ?>
								<a href="edades.php?modif=<?php echo $edades['estado'] ?>&id=<?php echo $edades['id']?>"><button type="button" class="btn btn-success" title="Activar">A</button></a>
							<?php } else { ?>
								<a href="edades.php?modif=<?php echo $edades['estado'] ?>&id=<?php echo $edades['id']?>"><button type="button" class="btn btn-warning" title="Desactivar">D</button></a>
							<?php } 
							?><a href="edades.php?del=<?php echo $edades['id'] ?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
						</td>
						</tr>
					<?php } ?> 
				</tbody>

			</table>
		</div>

	</div>
</div>

<?php include('inc/footer.php'); ?>