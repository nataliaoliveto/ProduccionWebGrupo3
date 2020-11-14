<?php 
require('inc/header.php');
 
?> 

<div class="container-fluid">
      
      <?php $perfilMenu = 'Perfiles';
	include('inc/side_bar.php');
	
	$perfil = new Perfil($con); 
	
	$query = 'SELECT * FROM permisos';
    $permisos = $con->query($query);
   // var_dump($permisos);
	
	if(isset($_GET['edit'])){
            $perfiles = $perfil->get($_GET['edit']); 
            //var_dump($perfiles);
	} 
	?>
	  
	  
        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </p>
          
	  <h1 class="page-header">
                    Nuevo Perfil
          </h1>
  
          <div class="col-md-2"></div>
            <form action="perfiles.php" method="post" class="col-md-6 from-horizontal">
                <div class="form-group">
                    <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo (isset($perfiles->nombre)?$perfiles->nombre:'');?>">
                    </div>
                </div> 
                 
                <div class="form-group">
                    <label for="tipo" class="col-sm-2 control-label">Permisos</label>
                    <div class="col-sm-10">
                        <select name="permisos[]" id="permisos" multiple='multiple' >
                            <?php  foreach($permisos as $t){?>
                                <option value="<?php echo $t['id']?>"
								<?php 
									if(isset($perfiles->permisos)){
										if(in_array($t['id'],$perfiles->permisos)){
											echo ' selected="selected" ';
										}
									}
								
								?>><?php echo $t['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div> 
                 
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="formulario_perfiles" >Guardar</button>
                    </div>
                </div> 
                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo (isset($perfiles->id)?$perfiles->id:'');?>">

            </form>
          </div>
 
          
      </div><!--/row-->
	</div>
</div><!--/.container-->

<?php include('inc/footer.php');?>