<!DOCTYPE html>
<?php session_start();
include('../dbo_con.php');

include('clases/usuarios.php');
include('clases/perfil.php');
include('clases/comentario.php');
include('clases/plataforma.php');
include('clases/genero.php');
include('clases/edad.php');
include('clases/producto.php');


try {
  $con = new PDO('mysql:host=' . $hostname . ';puerto=' . $puerto . ';dbname=' . $database, $username, $password);
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage();
  die();
}


$user = new Usuario($con);

if (isset($_POST['login'])) {
  $user->login($_POST);
}

if (isset($_GET['logout'])) {
  unset($_SESSION['usuario']);
}

if ($user->notLogged()) {
  header('Location: login.php');
}

?>
<html lang="es">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Panel de Control</title>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
  <link href="css/styles.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Bienvenido <?php echo $_SESSION['usuario']['nombre']  ?></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="?logout">Logout</a></li>
          
        </ul>
      </div>
    </div>
  </nav>