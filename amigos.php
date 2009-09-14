<?php
require ('cabecera.php');
	$id_user=$_SESSION['user_logged'];
	$sql = "SELECT `id_user2` FROM `amigos`	WHERE `id_user1` = '" . $id_user."'";
	$prueba=$db->select_varios($sql);
		echo "<h2>Tu lista de amigos</h2><ul id=\"mis_amigos\">";
		while($row = mysql_fetch_array($prueba)){
			echo "<li>Con ".user($row['id_user2'])." has ido ".fiestas_juntos($id_user,$row['id_user2'])." veces de fiesta. <a href=\"eliminar_amigo.php?id_amigo=".$row['id_user2']."\">Eliminar amigo</a></li>";
		}
		echo "</ul>";
		echo "<p><a href=\"gmail.php\">Añadir más amigos desde gmail</a></p>";
	require('pie.php');
?>