<?php 
require('inc/header.php');
?> 

<div class="container-fluid">
      
      <?php $newsMenu = 'Noticias';
	include('inc/side_bar.php');
	 

        ?>
	  
	  
        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </p>
          
		  <h1 class="page-header">
            <?php echo $newsMenu ?>
          </h1>
 

          <h2 class="sub-header">Listado <a href="#"><button type="button" class="btn btn-success" title="Agregar">A</button></a></h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Título</th>
                  <th>Fecha</th>
                  <th>Activa</th> 
				  <th>Acciones</th>
                </tr>
              </thead>
			  <tbody> 
              
						<tr>
						  <td>1</td>
						  <td>Nuevo lanzamiento de Apple</td>
						  <td>26/04/2018</td>
						  <td>Sí</td> 
						  <td>
						      <a href="#"><button type="button" class="btn btn-info" title="Modificar">M</button></a>
							  <a href="#"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
					      </td>
						</tr>
						<tr>
						  <td>1</td>
						  <td>Nuevo lanzamiento de Apple</td>
						  <td>26/04/2018</td>
						  <td>Sí</td> 
						  <td>
						      <a href="#"><button type="button" class="btn btn-info" title="Modificar">M</button></a>
							  <a href="#"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
					      </td>
						</tr>
						<tr>
						  <td>1</td>
						  <td>Nuevo lanzamiento de Apple</td>
						  <td>26/04/2018</td>
						  <td>Sí</td> 
						  <td>
						      <a href="#"><button type="button" class="btn btn-info" title="Modificar">M</button></a>
							  <a href="#"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
					      </td>
						</tr>         
              </tbody>
            </table>
          </div>
 
          
      </div><!--/row-->
	</div>
</div><!--/.container-->

<?php include('inc/footer.php');?>