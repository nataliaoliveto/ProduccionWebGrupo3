<!DOCTYPE html>
<html lang="es">

<?php 
    require "header.php";
?>

<body>
    <main>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <section class="contactosections">
                <h2 class="tituloseccioncontacto"><img src="imagenes/iconos/iconocontacto65.jpg" alt="Icono contacto tamaño 65" width="65" height="65" class="img-fluid rounded-circle"> Contáctenos</h2>
                <article>
                    <h3 class="contactoh3">Datos de contacto</h3>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col align-self-start">
                            <form action="mail.php" method="POST">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            Nombre
                                            <br>
                                            <input type="text" name="nombre" required>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            Apellido
                                            <br>
                                            <input type="text" name="apellido" required>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            Email
                                            <br>
                                            <input type="email" name="correo" required>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            Teléfono
                                            <br>
                                            <input type="tel" name="telefono" pattern="[0-9]{2}[0-9]{4}[0-9]{4}" required>
                                            <small><br>Ejemplo: 1164445555</small><br>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            Elige el área que recibirá la consulta<br>
                                            <input list="areas" name="areas" required>
                                            <datalist id="areas">
                                                <option value="Asistencia al usuario">
                                                <option value="Compras e historial">
                                                <option value="Legales">
                                                <option value="Medios de pagos">
                                                <option value="Novedades">
                                                <option value="Reclamos">
                                                <option value="Redes sociales">
                                                <option value="Soporte técnico">
                                            </datalist>
                                            <br>
                                        </div>
                                    </div>
                                    Escribe tu consulta y nos comunicaremos a la brevedad
                                    <br>
                                    <textarea rows="5" cols="50" name="mensaje" required></textarea>
                                    <br>
                                    <input type="checkbox" name="sicondiciones" value="si" required> He leído la información de protección de datos personales
                                    <br>
                                    Todos los campos son obligatorios
                                    <br>
                                    <input type="submit" value="Enviar">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>

    <?php  
    require "footer.php";
?>
</body>
</html>
