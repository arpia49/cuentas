<?php
	require('cabecera.php');
	$id_user=$_SESSION['user_logged'];
?>
<form action="procesar_amigos.php" method="post">
Correo del usuario <input type="text" name="correo" value="" /><br />
<input type="submit" name="login" value="Añadir" />
</form>
<p>
<a href="gmail.php">Amigos de Gmail</a><br />
Amigos de MSN
<?php
	require('pie.php');
?>