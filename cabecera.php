<?php
	require('libs/funciones.php');
	conectar();
	$db=new DB();
	session_start();
	$id_user=$_SESSION['user_logged'];
	if($id_user==""){
		header("location: index.php"); 
	}
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
	require 'login.php';
?>
