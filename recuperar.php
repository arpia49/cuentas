<?php
	require('libs/funciones.php');
	conectar();
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
	require('login.php');
	$comprobacion_get = comprobar_user_correo($_GET['user'], $_GET['correo']);
	$comprobacion_post = comprobar_user_correo($_POST['user'], $_POST['correo']);
	if ($comprobacion_post== NULL && $comprobacion_get== NULL){
?>
		Para poder obtener una nueva contraseña es necesario que introduzcas tu nombre de 
		usuario y tu correo. A esa dirección te llegará un enlace que te permitirá elegir una
		 nueva contraseña.
			<form action="recuperar.php" method="post">
			<p>Usuario <input type="text" name="user" maxlength="255" size="10" value="" /><br />
			Correo <input type="text" id="correo" name="correo" maxlength="100" size="10" value="" /><br />
			<input type="submit" name="login" value="Enviar" /></p>
			</form>
<?php

	} else {
		if(comprobar($_GET['user'])==$_GET['pass']){
			if($comprobacion_get!=""){
				?>
				<form action="actualizar_pass.php" method="post">
				<p>Nueva contraseña <input type="password" name="pass1" maxlength="255" size="10" value="" />
				<p>Repetir contraseña <input type="password" name="pass2" maxlength="255" size="10" value="" />
				<?php
				echo "<input type=\"hidden\" name=\"md5\" value=\"" . $comprobacion_get . "\" />";
				echo "<input type=\"hidden\" name=\"user\" value=\"" . $_GET['user'] . "\" />";
				?>
				<input type="submit" name="login" value="Enviar" /></p>
				</form>
				<?php
			}else{
				$enlace=DIR_WEB."recuperar.php?user=" .
                $_POST['user']."&correo=".$_POST['correo']."&pass=".$comprobacion_post;
				require_once("libs/class.phpmailer.php");
				$mail = new PHPMailer ();
				
				$mail -> From = $CORREO_ADMIN;
				$mail -> FromName = $NOMBRE_ADMIN;
				$mail -> AddAddress ($_POST['correo']);
				$mail -> Subject = "Contraseña de las rondas";
				$mail -> Body = "Te envío el enlace para cambiar tu contraseña: " .
						"<a href=\"".$enlace."\">". $enlace."</a>";
				$mail -> IsHTML (true);
				
				$mail->IsSMTP();
				$mail->Host = SMTP_CORREO;
				$mail->Port = PUERTO_CORREO;
				$mail->SMTPAuth = AUTH_CORREO;
				$mail->Username = CORREO_ADMIN;
				$mail->Password = PASSWORD_CORREO;
				
				if(!$mail->Send()) {
				   echo 'Error: ' . $mail->ErrorInfo;
				}
				else {
				   echo '¡Correo con la contraseña enviado!';
				}
			}
		}else{
			echo "Comprueba que hayas accedido desde el enlace correcto.";
		}
	}
	require ('pie.php');
?>