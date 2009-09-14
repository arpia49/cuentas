<?php
require ('cabecera_maps.php');
$id_user = $_SESSION['user_logged'];
$id_fiesta = $_GET['id_fiesta'];
echo "<h2>" . desc_fiesta($id_fiesta) . "</h2>";
?>
<div id="map_canvas" style="width: 500px; height: 300px"></div>
<?php
echo "<a href=\"ajustar_cuentas.php?id_fiesta=".$id_fiesta."\">Ajustar Cuentas</a>";

echo "<form action=\"actualizar.php\" method=\"post\">";
echo "<p><input type=\"hidden\" name=\"id_fiesta\" value=\"" . $id_fiesta . "\" />";

echo "Total de rondas de esta fiesta:</p><ul>";
$desc_rondas = desc_rondas($id_fiesta);
$rondas_fiestas_user = rondas_fiesta_user($id_user, $id_fiesta);

while ($row = mysql_fetch_array($rondas_fiestas_user)) {
	$id_ronda = $row['id_ronda'];
	$sql = "SELECT `id_user` FROM `rondas` WHERE `id_ronda` = '" . $id_ronda . "'";
	$id_user_ronda=$db->select_unico($sql);
	$sql2 = "SELECT `user` FROM `users` WHERE `id_user` = '" . $id_user_ronda . "'";
	$user_ronda=$db->select_unico($sql2);
	$sql3 = "SELECT `precio` FROM `rondas` WHERE `id_ronda` = '" . $id_ronda . "'";
	$precio_ronda=$db->select_unico($sql3);
	
	echo "<h3>" . desc_ronda($id_ronda) . ", ".$precio_ronda."€ pagados por ". $user_ronda;

	echo "</h3>Tus amigos en la ronda son: <br /><br />";
	echo "<li>Tú, que pagas " . mi_saldo($id_user, $id_ronda) . "€";
		if ($row['marcado'] == 1) {
		echo "<input type=\"checkbox\" name=\"" . $id_ronda . "\" checked=\"checked\" /></li>";
	} else {
		echo "<input type=\"checkbox\" name=\"" . $id_ronda . "\" /></li>";
	}
	$users_ronda = users_ronda($id_ronda);
	while ($row = mysql_fetch_array($users_ronda)) {
		if ($row['id_user'] != $id_user && $row['marcado'] == 1) {
			echo "<li>" . user($row['id_user']) . " que paga " . $row['saldo'] . "</li>";
		}
		elseif ($row['id_user'] != $id_user && $row['marcado'] == 0){
			echo "<li>" . user($row['id_user']) . " que <strong>NO</strong> paga" . "</li>";
		}
	}
	echo "<br /><hr />";
}
echo "</ul>";
?>
   <p><button name="enviar" value="Enviar" type="submit">Actualizar</button></p>
   </form>
<?php


echo "<p>¿Te falta <a href=\"crear_ronda.php?id_fiesta=" . $id_fiesta . "\">añadir alguna ronda</a>?";
echo "<br />¿Te falta <a href=\"crear_amigos.php?id_fiesta=" . $id_fiesta . "\">añadir amigos</a> a esta fiesta?</p>";
require ('pie.php');
?>