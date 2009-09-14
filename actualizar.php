<?php

	require('cabecera.php');
	$id_user=$_SESSION['user_logged'];
	$id_fiesta=$_POST['id_fiesta'];
	$rondas_fiesta_user=rondas_fiesta_user($id_user, $id_fiesta);
	while($row = mysql_fetch_array($rondas_fiesta_user)){
		$cambiar=0;
		if($_POST[$row['id_ronda']] == on){
			$cambiar=1;
		}
		
		
		
		cambiar($id_user,$row['id_ronda'],$cambiar);
		//arreglar
		if($_POST[$row['id_ronda']] != on){
			cambiar_saldo($id_user, $row['id_ronda'], 0);
		}
	}
	echo "<p>Los datos han sido actualizados.</p>";
	echo "<p><a href=\"fiesta.php?id_fiesta=".$id_fiesta."\">Volver a la fiesta</a></p>";
	require('pie.php');
?>