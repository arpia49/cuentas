<?php
require ('cabecera.php');
$id_user = $_SESSION['user_logged'];
if ($_POST['add'] == "si") {
	echo "Has insertado a:<br />";
	foreach ($_POST as $nombre_campo => $valor) {
		if($nombre_campo!="add" && $nombre_campo!="enviar"){
			echo user($nombre_campo)."<br />";
			insertar_amigo($id_user,$nombre_campo);
		}
	}
} else {
	$resultado = amigos_gmail($_POST);
//	print("<pre>".print_r($resultado,true)."</pre>");
	echo "<h2>Añadir amigos de gmail</h2>Tus amigos registrados pero sin añadir son: <br /><form id=\"amigos_gmail\" name=\"amigos_gmail\" action=\"procesar_gmail.php\" method=\"post\"><ul>";
	while ($row = mysql_fetch_array($resultado)) {
		if (es_amigo($id_user, $row['id_user']) == 0) {
			echo "<li>¿Añadir a " . user($row['id_user']) . " a la lista?<input type=\"checkbox\" name=\"" . $row['id_user'] . "\" checked=\"checked\" /></li>";
		}
	}
	echo "</ul>";
	echo "<p><input type=\"hidden\" name=\"add\" value=\"si\" />";
	echo "<button name=\"enviar\" value=\"Enviar\" type=\"submit\">Añadir</button></p></form>";
}
require ('pie.php');
?>