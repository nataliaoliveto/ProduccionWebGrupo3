<?php

if (isset($_GET["plataformas"]) && $_GET["plataformas"] != '') {
  $plataformaID = $_GET["plataformas"];
  foreach ($Plat->getPlataformas() as $plataformas) {
    if ($plataformas['id'] == $plataformaID)
    $lblBtnPlataformas = $plataformas['nombre'];  
  }
} else {
  $lblBtnPlataformas = 'Filtrar por Plataforma';
}

$generoID = '';   // Necesario para el filtro por edad.
if (isset($_GET["generos"]) && $_GET["generos"] != '') {
  $generoID = $_GET["generos"];
  foreach ($Gen->getGeneros() as $generos) {
    if ($generos['id'] == $generoID) {
      $lblBtnGeneros = $generos['nombre'];
    }
  }
} else {
  $lblBtnGeneros = 'Filtrar por Género';
}

if (isset($_GET["edades"]) && $_GET["edades"] != '') {
  $edadID = $_GET["edades"];
  foreach ($Edad->getEdadNombre($edadID) as $edades) {
      $lblBtnEdades = $edades['nombre'];
  }
} else {
  if ($generoID == '') {
    $lblBtnEdades = 'Seleccione Género';
  } else {
    $lblBtnEdades = 'Filtrar por Edad';
  } 
}

$lblSort = 'Destacados';
if (isset($_GET["sort"]) && $_GET["sort"] != '') {
  $sortID = $_GET["sort"];
  switch($sortID){
    case "1":
      $lblSort = 'Destacados';
      break;
    case "2":
      $lblSort = 'A-Z';
      break;
    case "3":
      $lblSort = 'Z-A';
      break;
    case "4":
      $lblSort = 'Ranqueados';
      break;  
  }
} 
?>

<div class="container">
  <div class="row">
    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
      <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $lblBtnPlataformas ?>
        </button>
        <div class="dropdown-menu">
          <?php
          foreach ($Plat->getPlataformas() as $plataformas) {
          ?>
            <a class="dropdown-item" href="listadoproductos.php?plataformas=<?php echo $plataformas['id'] ?>&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&sort=<?php echo isset($_GET['sort']) ? $_GET['sort'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>">
              <?php echo $plataformas['nombre']; ?>
            </a>
          <?php
          }
          ?>
          <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="listadoproductos.php?plataformas=&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&sort=<?php echo isset($_GET['sort']) ? $_GET['sort'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>">Eliminar filtro</a>
        </div>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $lblBtnGeneros ?>
        </button>
        <div class="dropdown-menu">
          <?php
          foreach ($Gen->getGeneros() as $generos) {
          ?>
            <a class="dropdown-item" href="listadoproductos.php?generos=<?php echo $generos['id'] ?>&plataformas=<?php echo isset($_GET['plataformas']) ? $_GET['plataformas'] : '' ?>&sort=<?php echo isset($_GET['sort']) ? $_GET['sort'] : '' ?>&edades=">
              <?php echo $generos['nombre']; ?>
            </a>
          <?php
          }
          ?>
          <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="listadoproductos.php?generos=&plataformas=<?php echo isset($_GET['plataformas']) ? $_GET['plataformas'] : '' ?>&sort=<?php echo isset($_GET['sort']) ? $_GET['sort'] : '' ?>&edades=">Eliminar filtro</a>
        </div>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $lblBtnEdades ?>
        </button>
        <div class="dropdown-menu">
          <?php
          if ($generoID != '') {
            foreach($Edad->getGeneroEdades($generoID) as $genEdad){
              foreach($Edad->getEdadNombre($genEdad['idedad']) as $edad){
              ?> 
                <a class="dropdown-item" href="listadoproductos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&plataformas=<?php echo isset($_GET['plataformas']) ? $_GET['plataformas'] : '' ?>&sort=<?php echo isset($_GET['sort']) ? $_GET['sort'] : '' ?>&edades=<?php echo $edad['id'] ?>">
                  <?php echo $edad['nombre']; ?>
                </a>
              <?php
              }              
            }
          }
          ?>          
          <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="listadoproductos.php?generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&plataformas=<?php echo isset($_GET['plataformas']) ? $_GET['plataformas'] : '' ?>&sort=<?php echo isset($_GET['sort']) ? $_GET['sort'] : '' ?>&edades=">Eliminar filtro</a>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
      <div class="btn-group">
        <button type="button" id= "buttonOrderBy" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $lblSort ?>
        </button>
        <div class="dropdown-menu">          
            <a class="dropdown-item" href="listadoproductos.php?sort=1&plataformas=<?php echo isset($_GET['plataformas']) ? $_GET['plataformas'] : '' ?>&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>">
              Destacados
            </a>
            <a class="dropdown-item" href="listadoproductos.php?sort=4&plataformas=<?php echo isset($_GET['plataformas']) ? $_GET['plataformas'] : '' ?>&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>">
              Ranqueados
            </a>
            <a class="dropdown-item" href="listadoproductos.php?sort=2&plataformas=<?php echo isset($_GET['plataformas']) ? $_GET['plataformas'] : '' ?>&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>">
              A-Z
            </a>
            <a class="dropdown-item" href="listadoproductos.php?sort=3&plataformas=<?php echo isset($_GET['plataformas']) ? $_GET['plataformas'] : '' ?>&generos=<?php echo isset($_GET['generos']) ? $_GET['generos'] : '' ?>&edades=<?php echo isset($_GET['edades']) ? $_GET['edades'] : '' ?>">
              Z-A
            </a>
          </div>
      </div>
    </div>  
  </div>
</div>