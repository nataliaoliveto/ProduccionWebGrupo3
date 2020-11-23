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

    foreach($Prod->getProducto_campos_dinamicos(65) as $prodCamposDin){
        echo($prodCamposDin['type']);
        echo($prodCamposDin['label']);
    }

    $str = 'In My Cart : valor_ingresado12 valor_ingresado33 valor_ingresado71  items';
    preg_match_all('!\d+!', $str, $matches);
    $str = $matches;
    var_dump($str);
?>