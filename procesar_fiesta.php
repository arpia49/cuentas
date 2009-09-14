<?php
	require('cabecera.php');
	$id_user=$_SESSION['user_logged'];
	$descripcion=$_POST['descripcion'];
	$id_fiesta=crear_fiesta($id_user, $descripcion);
	echo "<p>¿Te falta <a href=\"crear_ronda.php?id_fiesta=".$id_fiesta."\">añadir alguna ronda</a>?";
	echo "<br />¿Te falta <a href=\"crear_amigos.php?id_fiesta=".$id_fiesta."\">añadir amigos</a> a esta fiesta?</p>";
	require('pie.php');
?>