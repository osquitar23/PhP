<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" href="miestilo.css">
</head>
<?php

error_reporting(2);
session_start();
if(!isset($_SESSION['session_username']))// aqui niega, que si no hay datos en la sesion, volver a la pagina de login.
{
header("location: Login.php");	
}

?>
<div id="welcome">
<h2>¡Bienvenido!
<span>
<?php
echo $_SESSION['session_username'];//es el array donde se guardan los datos de las sesiones.
?>
</span></h2>
<p><a href="Logout.php">Finalice</a> sesion aqui!</p>
</div>
<?php
include("Footer.php");
?>
<body>
</body>
</html>