<?php
require('inc/header.php');
?>

<div class="container-fluid">

	<?php $comentarioMenu = 'Comentarios';
	$comen = new Comentario($con);
	include('inc/side_bar.php');

	if(isset($_GET['modif'], $_GET['id'])){
		$comen->update($_GET['modif'], $_GET['id']);
		header('Location: comentarios.php?estado='.$_GET['estado']);	
	}

	?>

	<div class="col-sm-9 col-md-10 main">

		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>

		<h1 class="page-header">
			<?php echo $comentarioMenu ?>
		</h1>

		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Ranqueo</th>
						<th>Producto</th>
						<th>Fecha</th>
						<th>Comentario</th>
						</tr> 
				</thead>
				
				<?php $lblSort = 'Inactivos';
					if (isset($_GET["estado"]) && $_GET["estado"] != '') {
					$sortID = $_GET["estado"];
					switch($sortID){
						case "0":
						$lblSort = 'Inactivos';
						break;
						case "1":
						$lblSort = 'Activos';
						break;
						case "2":
						$lblSort = 'Todos';
						break;  
						}
					} ?>

				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
					<div class="btn-group">
					<button type="button" id= "buttonOrderBy" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo $lblSort ?>
					</button>
					<div class="dropdown-menu">          
						<a class="dropdown-item" href="comentarios.php?estado=0">
						Inactivos
						</a>
						<a class="dropdown-item" href="comentarios.php?estado=1">
						Activos
						</a>
						<a class="dropdown-item" href="comentarios.php?estado=2">
						Todos
						</a>
					</div>
				</div>
	
				<tbody>
				
					<?php 
					foreach ($comen->getList($_GET['estado']) as $comentarios) { ?>
						<tr>
						<td><?php echo $comentarios['id'];?></td>
						<td><?php echo $comentarios['calificacion'];?></td>
						<td><?php echo $comentarios['nombre'];?></td>
						<td><?php echo $comentarios['fecha'];?></td>
						<td><?php echo $comentarios['descripcion'];?></td>
						<td>
							<?php if($comentarios['estado'] == 0){ ?>
								<a href="comentarios.php?estado=<?php echo $_GET['estado']?>&modif=<?php echo $comentarios['estado'] ?>&id=<?php echo $comentarios['id']?>"><button type="button" class="btn btn-success" title="Activar">A</button></a>
							<?php } else { ?>
								<a href="comentarios.php?estado=<?php echo $_GET['estado']?>&modif=<?php echo $comentarios['estado'] ?>&id=<?php echo $comentarios['id']?>"><button type="button" class="btn btn-danger" title="Desactivar">D</button></a>
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