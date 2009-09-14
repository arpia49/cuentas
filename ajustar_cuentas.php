<?php
require ('cabecera.php');
	$id_user = $_SESSION['user_logged'];
	$id_fiesta = $_GET['id_fiesta'];
	$users_fiesta=users_fiesta($id_fiesta);

	$sql = "SELECT `descripcion`  FROM `fiestas` WHERE `id_fiesta` = " . $id_fiesta;
	$desc_fiesta=$db->select_unico($sql);

	echo ("<p>Volver a <a href=\"fiesta.php?id_fiesta=".$id_fiesta."\">".$desc_fiesta."</a></p>");

	while($row = mysql_fetch_array($users_fiesta)){	

		$pagado = pagado($row['id_user'], $id_fiesta);
		$pagar = pagar($row['id_user'], $id_fiesta);
		$saldo=$pagar-$pagado;
		echo user($row['id_user'])." tiene un saldo de ".$saldo."€<br />";
	}

	echo ("<p>Volver a <a href=\"fiesta.php?id_fiesta=".$id_fiesta."\">".$desc_fiesta."</a></p>");
	require ('pie.php');
?>