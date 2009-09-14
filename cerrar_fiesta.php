<?php
require ('cabecera.php');
$id_user = $_SESSION['user_logged'];
$id_fiesta = $_GET['id_fiesta'];
if($id_user!=creador_fiesta($id_fiesta)){
	echo "La fiesta que has intentado cerrar no fue abierta por ti.";
}
else{
?>
La fiesta se ha cerrado,a  partir de ahora no aparecerá en la página de inicio, sino que tendrás que buscarla en el historial (cuando implente el historial, claro está).
<?php
	$sql = "UPDATE `fiestas` SET `abierto` = '1' WHERE `id_fiesta` ='" . $id_fiesta . "'";
	db->update($sql);
}
require ('pie.php');
?>
