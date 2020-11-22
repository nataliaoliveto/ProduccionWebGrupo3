<div class="row row-offcanvas row-offcanvas-left">

	<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">

		<ul class="nav nav-sidebar">
			
			<?php if (isset($_SESSION['usuario']['permisos']['seccion'])) { ?>

				<?php
				if (in_array('comen', $_SESSION['usuario']['permisos']['seccion'])) { ?>
					<li class="<?php echo isset($comentarioMenu) ? 'active' : '' ?>"><a href="comentarios.php?estado=0&pagina=1&idprod=0">Comentarios</a></li>
				<?php } 

				if (in_array('camcom', $_SESSION['usuario']['permisos']['seccion'])) { ?>
					<li class="<?php echo isset($campoComentarioMenu) ? 'active' : '' ?>"><a href="campos_comentarios.php">Campos Comentarios</a></li>
				<?php }

				if (in_array('edad', $_SESSION['usuario']['permisos']['seccion'])) { ?>
					<li class="<?php echo isset($edadMenu) ? 'active' : '' ?>"><a href="edades.php">Edades</a></li>
				<?php } 

				if (in_array('gen', $_SESSION['usuario']['permisos']['seccion'])) { ?>
					<li class="<?php echo isset($generoMenu) ? 'active' : '' ?>"><a href="generos.php">Géneros</a></li>
				<?php } 

				if (in_array('per', $_SESSION['usuario']['permisos']['seccion'])) { ?>
					<li class="<?php echo isset($perfilMenu) ? 'active' : '' ?>"><a href="perfiles.php">Perfiles</a></li>
				<?php } 

				if (in_array('pla', $_SESSION['usuario']['permisos']['seccion'])) { ?>
					<li class="<?php echo isset($plataformaMenu) ? 'active' : '' ?>"><a href="plataformas.php">Plataformas</a></li>
				<?php } 

				if (in_array('prod', $_SESSION['usuario']['permisos']['seccion'])) { ?>
					<li class="<?php echo isset($productoMenu) ? 'active' : '' ?>"><a href="productos.php?pagina=1">Productos</a></li>
				<?php } 

				if (in_array('usu', $_SESSION['usuario']['permisos']['seccion'])) { ?>
					<li class="<?php echo isset($userMenu) ? 'active' : '' ?>"><a href="usuarios.php">Usuarios</a></li>
				<?php } ?>

			<?php } ?>
				
		</ul>
	</div>
