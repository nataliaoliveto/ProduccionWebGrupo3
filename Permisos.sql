INSERT INTO permisos (nombre, cod, seccion, enabled) 
VALUES
	('Activar Comentarios', 'comen.act', 'comen', 1),
	('Agregar Campos Comentarios', 'camcom.add', 'camcom', 1),
	('Modificar Campos Comentarios', 'camcom.edit', 'camcom', 1),
	('Eliminar Campos Comentarios', 'camcom.del', 'camcom', 1),
	('Activar Campos Comentarios', 'camcom.act', 'camcom', 1),

	('Agregar Edades', 'edad.add', 'edad', 1),
	('Modificar Edades', 'edad.edit', 'edad', 1),
	('Eliminar Edades', 'edad.del', 'edad', 1),
	('Activar Edades', 'edad.act', 'edad', 1),

	('Agregar Generos', 'gen.add', 'gen', 1),
	('Modificar Generos', 'gen.edit', 'gen', 1),
	('Eliminar Generos', 'gen.del', 'gen', 1),
	('Activar Generos', 'gen.act', 'gen', 1),

	('Agregar Perfiles', 'per.add', 'per', 1),
	('Modificar Perfiles', 'per.edit', 'per', 1),
	('Eliminar Perfiles', 'per.del', 'per', 1),
	('Activar Perfiles', 'per.act', 'per', 1),

	('Agregar Plataformas', 'pla.add', 'pla', 1),
	('Modificar Plataformas', 'pla.edit', 'pla', 1),
	('Eliminar Plataformas', 'pla.del', 'pla', 1),
	('Activar Plataformas', 'pla.act', 'pla', 1),

	('Agregar Productos', 'prod.add', 'prod', 1),
	('Modificar Productos', 'prod.edit', 'prod', 1),
	('Eliminar Productos', 'prod.del', 'prod', 1),
	('Activar Productos', 'prod.act', 'prod', 1),

	('Agregar Usuarios', 'usu.add', 'usu', 1),
	('Modificar Usuarios', 'usu.edit', 'usu', 1),
	('Eliminar Usuarios', 'usu.del', 'usu', 1),
	('Activar Usuarios', 'usu.act', 'usu', 1);
    
    
    /*
    
		1) Administrador
			+ SELECT *				

		2) Marketing
			- Ve Productos (Comentarios), Comentarios, Campos Comentario
			+ Agregar Productos, Campos Comentarios			
			+ Modifica Campos Comentarios
			+ Elimina Campos Comentarios
			+ Activa/Desactiva Comentarios, Campos Comentarios

		3) RRHH
			- Ve Usuarios, Ve Perfiles
			+ Agregar Usuarios
			+ Modifica Usuarios

		4) BackOffice	
			- Ve Productos, Plataformas, Generos, Edades
			+ Agregar Productos, Plataformas, Generos, Edades
			+ Modifica Productos, Plataformas, Generos, Edades
			+ Elimina Productos, Plataformas, Generos, Edades
			+ Activa/Desactiva Productos, Plataformas, Generos, Edades
    
    */
