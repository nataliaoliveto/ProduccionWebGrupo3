<?php
require('header.php');
$produ = new Producto($con);

$lblSort = 'Inactivos';
    if (isset($_GET["estado"]) && $_GET["estado"] != '') {
    $sortID = $_GET["estado"];
    switch($sortID){
        case "0":
        $lblSort = 'Inactivos';
        break;
        case "1":
        $lblSort = 'Activos';
        break;
        case "2":
        $lblSort = 'Todos';
        break;  
        }
    }

$generoID = '';   // Necesario para el filtro por edad.
    if (isset($_GET["generos"]) && $_GET["generos"] != '') {
    $generoID = $_GET["generos"];
    foreach ($produ->getGeneros() as $generos) {
        if ($generos['id'] == $generoID) {
            $lblBtnGeneros = $generos['nombre'];
        }
    }
    } else {
    $lblBtnGeneros = 'Filtrar por Género';
    }

    if (isset($_GET["edades"]) && $_GET["edades"] != '') {
    $edadID = $_GET["edades"];
    foreach ($produ->getEdadNombre($edadID) as $edades) {
        $lblBtnEdades = $edades['nombre'];
    }
    } else {
    if ($generoID == '') {
        $lblBtnEdades = 'Seleccione Género';
    } else {
        $lblBtnEdades = 'Filtrar por Edad';
    }
}

?>