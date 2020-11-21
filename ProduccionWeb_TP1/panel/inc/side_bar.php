<div class="row row-offcanvas row-offcanvas-left">

	<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">

		<ul class="nav nav-sidebar">
		<?php if (in_array('user', $_SESSION['usuario']['permisos']['seccion'])) { ?>
			<li class="<?php echo isset($comentarioMenu) ? 'active' : '' ?>"><a href="comentarios.php?estado=0&pagina=1&idprod=0">Comentarios</a></li>
			<li class="<?php echo isset($edadMenu) ? 'active' : '' ?>"><a href="edades.php">Edades</a></li>
			<li class="<?php echo isset($generoMenu) ? 'active' : '' ?>"><a href="generos.php">Géneros</a></li>
			<li class="<?php echo isset($perfilMenu) ? 'active' : '' ?>"><a href="perfiles.php">Perfiles</a></li>
			<li class="<?php echo isset($plataformaMenu) ? 'active' : '' ?>"><a href="plataformas.php">Plataformas</a></li>
			<li class="<?php echo isset($productoMenu) ? 'active' : '' ?>"><a href="productos.php?pagina=1">Productos</a></li>
			<li class="<?php echo isset($userMenu) ? 'active' : '' ?>"><a href="usuarios.php">Usuarios</a></li>
			<?php } ?>
		</ul>
	</div>
