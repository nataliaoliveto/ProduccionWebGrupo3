<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$area = $_POST['areas'];
$fecha = date("d/m/Y H:i:s");

$asunto = "Contacto a " . $area;
$to = "dvpwg3@gmail.com";
$redireccionar = "contacto.php";

$contenido = $asunto . "\nFecha de contacto: " . $fecha . "\nNombre: " . $nombre . "\nApellido: " . $apellido . "\nCorreo: " . $correo ."\nTeléfono: " . $telefono . "\nMensaje: " . "\n" . $mensaje . "\n ------ FIN DEL MENSAJE ------";

mail($to, $asunto, $contenido);
header('Location: ' . $redireccionar);
    
?>