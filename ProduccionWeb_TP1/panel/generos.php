<?php
require('inc/header.php');
?>

<div class="container-fluid">

	<?php $generoMenu = 'Géneros';
	$gen = new Genero($con);
	include('inc/side_bar.php');

	if(isset($_GET['modif'], $_GET['id'])){
		$gen->update($_GET['modif'], $_GET['id']);
		header('Location: generos.php');	
	}

	if(isset($_POST['formulario_generos'])){ 
		$gen->edit($_POST);
	}
	
		$mensaje = false;
	if(isset($_POST['alta_generos'])){
		if($gen->save($_POST) == 1){
			$mensaje = true;
		} 
	}

	
	?>

	<div class="col-sm-9 col-md-10 main">
		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>

		<h1 class="page-header">
			<?php echo $generoMenu ?>
		</h1>

		<div class="container-fluid">

			<form action="generos.php" method="post" class="navbar-form navbar-left">
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nuevo género"> 
				<button type="submit" class="btn btn-success" name="alta_generos" title="Agregar">Nuevo Género</button></a>
				<?php if ($mensaje) {
				?>  <p id="errorComentario"> Error al cargar género: nombre existente </p>
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
						<th>Edades relacionadas</th>
						<th>Acciones</th>
					</tr>
				</thead>

				<tbody>
					<?php 
					foreach ($gen->getList() as $generos) { ?>
						<tr>
						<td><?php echo $generos['id'];?></td>
						<td><?php echo $generos['nombre'];?></td>
						<td><?php if($generos['estado'] == 1){
							echo 'Activa';
						} else {
							echo 'Inactiva';
						} 	?></td>	
						<td> <?php 
						$haysubcat = false;
						foreach ($gen->getSubcategoria($generos['id']) as $subcat) {
									$haysubcat = true;
									echo $subcat['nombre'];
									?> <br> <?php
								}
								if(!$haysubcat){
									echo "No hay edades relacionadas";
								} ?></td>
						<td>
						<a href="generos_ae.php?edit=<?php echo $generos['id']?>"><button type="button" class="btn btn-info" title="Modificar nombre">M</button></a>
							<?php if($generos['estado'] == 0){ ?>
								<a href="generos.php?modif=<?php echo $generos['estado'] ?>&id=<?php echo $generos['id']?>"><button type="button" class="btn btn-success" title="Activar">A</button></a>
							<?php } else { ?>
								<a href="generos.php?modif=<?php echo $generos['estado'] ?>&id=<?php echo $generos['id']?>"><button type="button" class="btn btn-danger" title="Desactivar">D</button></a>
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