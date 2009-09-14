<?php
	require('cabecera.php');
	$id_user=$_SESSION['user_logged'];
	$id_fiesta=$_GET['id_fiesta'];
	$id_amigo=$_GET['id_amigo'];
	if($_GET['borrar']=="1"){
		$sql = "DELETE FROM `amigos` WHERE `id_user1` = ".$id_user." AND `id_user2` = ".$id_amigo;
		$desc_fiesta=$db->update($sql);
		echo "Has borrado a ".user($id_amigo)." de tu lista de amigos";
	}else{
		echo "<a href=\"eliminar_amigo.php?id_amigo=".$id_amigo."&borrar=1\">Eliminar a ".user($id_amigo)."</a>";
	}
?>