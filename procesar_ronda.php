<?php
	require('cabecera.php');
	$descripcion=$_POST['descripcion'];
	$precio=$_POST['precio'];
	$id_fiesta=$_POST['id_fiesta'];
	if(estado($id_fiesta)==1){
		echo "Esta fiesta está cerrada.";
	}else{
	crear_ronda($id_user, $descripcion, $precio, $id_fiesta);
	echo "<p>Ronda creada.<br /><a href=\"fiesta.php?id_fiesta=".$id_fiesta."\">Ir a los cálculos de la fiesta</a>";
	echo "<br />¿Te falta <a href=\"crear_amigos.php?id_fiesta=".$id_fiesta."\">añadir amigos</a> a esta fiesta?</p>";
		}
	require('pie.php');
?>