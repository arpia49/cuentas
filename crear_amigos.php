<?php
require ('cabecera.php');
	$id_user = $_SESSION['user_logged'];
	$id_fiesta = $_GET['id_fiesta'];
   	$sql = "SELECT `id_user2` FROM `amigos`	WHERE `id_user1` = '" . $id_user."'";
	$mis_amigos=$db->select_varios($sql);
//		while($row = mysql_fetch_array($prueba)){
//	$mis_amigos = mis_amigos($id_user);
	if (estado($id_fiesta)==0) {
		echo "<h2>Añadir amistad a la fiesta</h2><ul>";
		echo "<form action=\"amigos_a_fiesta.php\" method=\"post\">";
		$users_fiesta = users_fiesta($id_fiesta);
		$lista_users = array ();
		while ($row = mysql_fetch_array($users_fiesta)) {
			array_push($lista_users, $row['id_user']);
		}
		while ($row = mysql_fetch_array($mis_amigos)) {
			$id_amigo = $row['id_user2'];
			echo "<li>" . user($id_amigo);
			if (in_array($id_amigo, $lista_users)) {
				echo "<input type=\"checkbox\" name=\"novale\" checked=\"checked\" disabled /></li>";
			} else {
				echo "<input type=\"checkbox\" name=\"" . $id_amigo . "\" /></li>";
			}
		}
		echo "<p><input type=\"hidden\" name=\"id_fiesta\" value=\"" . $id_fiesta . "\" />";
		echo "<button name=\"enviar\" value=\"Enviar\" type=\"submit\">Añadir</button></p>";
		echo "</form></ul>";
	} else {
	echo "La fiesta a la que intentas añadir amigos está cerrada.";
	}
	echo "<br /><a href=\"fiesta.php?id_fiesta=" . $id_fiesta . "\">Volver a la fiesta</a>";

require ('pie.php');
?>