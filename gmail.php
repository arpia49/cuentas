<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	   <title>Gestor de cuentas</title>
	   <meta http-equiv="Content-Type"
	    content="text/html; charset=utf-8" />
	    <link rel="stylesheet" type="text/css" media="screen" href="libs/estilo.css" />
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Gestor de cuentas</title>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type="text/javascript"
  src="libs/gmail.js">
</script>
<script type='text/javascript'>
google.load("gdata", "1.x");
google.setOnLoadCallback(initFunc);
</script>
	</head>
	<body>
		<div id="cabecera">
			<a href=".">
				<img src="imagenes/logo.png" alt="Logo de la web" />
			De rondas</a>
		</div>
<?php
echo "<h2>Buscar en tus amigos de gmail</h2>";
echo "<button name=\"permitir\" id=\"boton_permitir\" value=\"permitir\" onclick=\"javascript:logMeIn()\" \"type=\"submit\" disabled>Permitir acceso a Gmail</button>";
echo "<form id=\"gmail\" name=\"gmail\" action=\"procesar_gmail.php\" method=\"post\">";
echo "<button name=\"enviar\" id=\"boton_enviar\" value=\"Enviar\" type=\"submit\" disabled>Buscar</button></p>";
echo "</form>";
$id_user = $_SESSION['user_logged'];
require ('pie.php');
?>
