<div class="row row-offcanvas row-offcanvas-left">

	<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">

		<ul class="nav nav-sidebar">
		<?php if (in_array('user', $_SESSION['usuario']['permisos']['seccion'])) { ?>
			<li class="<?php echo isset($productsMenu) ? 'active' : '' ?>"><a href="productos.php">Productos</a></li>
			<li class="<?php echo isset($userMenu) ? 'active' : '' ?>"><a href="usuarios.php">Usuarios</a></li>
			<li class="<?php echo isset($perfilMenu) ? 'active' : '' ?>"><a href="perfiles.php">Perfiles</a></li>
			<li class="<?php echo isset($comentarioMenu) ? 'active' : '' ?>"><a href="comentarios.php?estado=0">Comentarios</a></li>
			<li class="<?php echo isset($generoMenu) ? 'active' : '' ?>"><a href="generos.php">Géneros</a></li>
			<li class="<?php echo isset($plataformaMenu) ? 'active' : '' ?>"><a href="plataformas.php">Plataformas</a></li>
			<?php } ?>
		</ul>
	</div>
