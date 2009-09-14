<?php
session_start();
if ($id_user != "") {
	echo "<div id=\"login\">";
	echo user($id_user) . " ";
?>
	<a href="cerrar.php">Cerrar sesión</a> | <a href="ChangeLog">Lista de cambios</a>
	</div>
	<div id="menu">
		<p>| <a href=".">Inicio</a> | Mis fiestas | <a href="amigos.php">Mis Amigos</a> | <a href="crear_fiesta.php">+ Nueva fiesta</a> | <a href="nuevos_amigos.php">+ Nuevos Amigos</a> |</p>
	</div>
<?php
}
?>