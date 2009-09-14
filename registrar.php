<?php
	if($_POST['user']!="" || $_POST['password']!="" || $_POST['correo']!=""){
		require('libs/funciones.php');
		conectar();
		session_start();
		registrar($_POST['user'],md5($_POST['password']),$_POST['correo']);
		$id_user = id_user($_POST['user']);
		$_SESSION['user_logged'] = $id_user;
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	   <title>Gestor de cuentas</title>
	   <meta http-equiv="Content-Type"
	    content="text/html; charset=utf-8" />
	    <link rel="stylesheet" type="text/css" media="screen" href="libs/estilo.css" />
	</head>
	<body>
		<div id="cabecera">
			<a href=".">
				<img src="imagenes/logo.png" alt="Logo de la web" />
			De rondas</a>
		</div>

<?php
	$id_user=$_SESSION['user_logged'];
	require 'login.php';


		echo "<br />Te has registrado con el usuario <strong>".$_POST['user'].
		"</strong> y la contraseña <strong>".$_POST['password']."</strong><br />
		Te recuerdo que no guardo la contraseña en claro sino el md5, así que no temas :D";
	}
	else{
		require('cabecera.php');
	?>
		<div id="registrar">
		<form action="registrar.php" method="post">
			<p>Usuario <input type="text" name="user" maxlength="255" size="10" value="" />
			<br />Contraseña <input type="password" id="password" name="password" maxlength="255" size="10" value="" />
			<br />Correo  <input type="text" id="correo" name="correo" size="10" value="" />
			<input type="submit" name="registrar" value="Registar" /></p>
		</form>
	</div>
	<?php
	}
	require('pie.php');
?>