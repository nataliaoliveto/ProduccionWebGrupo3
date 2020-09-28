<?php
    require_once('dbo_con.php');
    try{
        $con = new PDO('mysql:host='.$hostname.';dbname='.$database.';port='.$puerto, $username, $password);
    }
    catch (PDOException $e) {
        print "Error: ".$e->getMessage();
        die();
    }
    require "productos.php";
    require "generos.php";
    require "edades.php";
    require "plataformas.php";

    $Prod = new Productos($con);
    $Gen = new Generos($con);
    $Edad = new Edades($con);
    $Plat = new Plataformas($con);    
?>  

<header>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/estilos.css">
    <!--fuentes-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <title>GAME STORE</title>

</head>
    <nav class="navbar navbar-expand-lg navbar-expand-md fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php"><img src="imagenes/iconos/iconologo30.jpg" alt="Icono logo" width="30" height="30" class="img-fluid rounded-circle float-left">GAMESTORE</a></li>
                <li class="nav-item"><a class="nav-link" href="listadoproductos.php?sort=1"><img src="imagenes/iconos/iconocatalogo30.png" alt="Icono catálogo 30" width="30" height="30" class="img-fluid float-left">CATÁLOGO</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php"><img src="imagenes/iconos/iconocontacto30.png" alt="Icono contacto 30" width="30" height="30" class="img-fluid float-left">CONTACTO</a></li>
            </ul>
        </div>
    </nav>

</header>
