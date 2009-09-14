<?php

//sin uso de funciones.php feas

	require('libs/funciones.php');
	$db=new DB();
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	   <title>Gestor de cuentas</title>
	   <meta http-equiv="Content-Type"
	    content="text/html; charset=utf-8" />
	    <link rel="stylesheet" type="text/css" media="screen" href="libs/estilo.css" />
	</head>
	<body>
		<div id="cabecera">
			<a href=".">
				<img src="imagenes/logo.png" alt="Logo de la web" />
			De rondas</a>
		</div>

<?php
	require 'login.php';
	$md5 = $_POST['md5'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$user = $_POST['user'];
	if($pass1==$pass2){
		$sql_comprobar = "SELECT pass FROM `users` WHERE `user` = '" . $user . "'";
		if($db->select_unico($sql_comprobar) == $md5){
			$sql_id_user = "SELECT `id_user` FROM `users` WHERE `user` = '" . $user . "'";
			$id_user=$db->select_unico($sql_id_user);
			$sql_cambiar_pass = "UPDATE `users` SET `pass` = '" . md5($pass1). "' WHERE `id_user` ='" . $id_user . "'";
			$db->update($sql_cambiar_pass);
			echo "Has cambiado la contraseña";
		}
		else{
			echo "Comprueba que hayas accedido desde el enlace correcto.";
		}
	}else{
		echo "Las contraseñas no son iguales";
		?>
			<form action="actualizar_pass.php" method="post">
			<p>Nueva contraseña <input type="password" name="pass1" maxlength="255" size="10" value="" />
			<p>Repetir contraseña <input type="password" name="pass2" maxlength="255" size="10" value="" />
			<?php
			echo "<input type=\"hidden\" name=\"md5\" value=\"" . $md5 . "\" />";
			echo "<input type=\"hidden\" name=\"user\" value=\"" . $user . "\" />";
			?>
			<input type="submit" name="login" value="Enviar" /></p>
			</form>
		<?php
	}
?>