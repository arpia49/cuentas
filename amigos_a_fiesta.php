<?php
require ('cabecera.php');
$id_user = $_SESSION['user_logged'];
$id_fiesta = $_POST['id_fiesta'];
if ($id_fiesta != "" && estado($id_fiesta) == 0) {
	$lista_users = array ();
	$mis_amigos = mis_amigos($id_user);
	$rondas_fiesta = rondas_fiesta($id_fiesta);
	while ($row = mysql_fetch_array($mis_amigos[0])) {
		if ($row['id_user1'] != $id_user) {
			array_push($lista_users, $row['id_user1']);
		} else {
			array_push($lista_users, $row['id_user2']);
		}
	}
	foreach ($lista_users as $id_amigo) {
		if ($_POST[$id_amigo] == "on") {
			insertar_usuario_fiesta($id_amigo, $id_fiesta);
			echo "Has añadido a " . user($id_amigo) . " a la fiesta<br />";
			//habría q optimizar
			$rondas_fiesta = rondas_fiesta($id_fiesta);
			while ($row2 = mysql_fetch_array($rondas_fiesta)) {
				insertar_usuario_rondas($id_amigo,$row2['id_ronda']);
			}
		}
	}

	$rondas_fiesta = rondas_fiesta($id_fiesta);
	while($row = mysql_fetch_array($rondas_fiesta)){
		$id_ronda=$row['id_ronda'];
		$a_pagar=pagar_ronda($id_ronda);
		$users_ronda=users_ronda($id_ronda);
		while($row = mysql_fetch_array($users_ronda)){
			cambiar_saldo($row['id_user'], $id_ronda, $a_pagar);
		}
	}
		
	echo "<br />¿Te falta <a href=\"crear_amigos.php?id_fiesta=" . $id_fiesta . "\">añadir amigos</a> a esta fiesta?</p>";
	echo "<br /><a href=\"fiesta.php?id_fiesta=" . $id_fiesta . "\">Volver a la fiesta</a>";
}
require ('pie.php');
?>