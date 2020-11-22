<<?php



/*Funcion de redireccionamiento de paginas*/

function redirect($pURL) 
{	
	if (strlen($pURL) > 0) 
	{ 
		if (headers_sent()) 
		{
			echo "<script>document.location.href='".$pURL."';</script>\n"; 
		}else 
		{
			header("Location: " . $pURL);
		}
 
		exit();
	}	
}
 

//redimencionar imagen
/* 
	$tamanhos = array(0 => array('nombre'=>'big','ancho'=>'5000','alto'=>'10000'),
					  1 => array('nombre'=>'small','ancho'=>'500','alto'=>'1000'),
					  2 => array('nombre'=>'thumb','ancho'=>'50','alto'=>'70'));
*/
				  


//funcion para obtener la extension
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
 //Funcion para borrar imagenes
function eliminar_archivos($carpeta,$id)
{
	$dir = '../file_sitio/'.$carpeta.'/'.$id.'/';
	if(is_dir($dir)){
		$directorio=opendir($dir); 
		while ($archivo = readdir($directorio))
		{
			if($archivo != '.' and $archivo != '..')
			{
				@unlink($dir.$archivo);
			}
		}
		closedir($directorio); 
		@rmdir($dir);
	}
}
