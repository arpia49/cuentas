<?php
	require('libs/funciones.php');
	$db=new DB();
	session_start();
	$id_user=$_SESSION['user_logged'];
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
	<body onload="ocultar()">
		<div id="cabecera">
			<a href='.'>
				<img src='imagenes/logo.png' alt='Logo de la web' />
			De rondas</a>
		</div>
		<script type='text/javascript'>
            function ocultar() {
                var formularioRecuperar = document.getElementById("formulario_recuperar");
                var formularioRegistrar = document.getElementById("formulario_registrar");
                var enlaceEntrar = document.getElementById("enlace_entrar");
				formularioRecuperar.style.visibility = "hidden";
				formularioRegistrar.style.visibility = "hidden";
			}
            function clic_entrar() {
                var formularioRecuperar = document.getElementById("formulario_recuperar");
                var formularioEntrar = document.getElementById("formulario_entrar");
                var formularioRegistrar = document.getElementById("formulario_registrar");
				formularioEntrar.style.visibility = "visible";
				formularioRegistrar.style.visibility = "hidden";
                formularioRecuperar.style.visibility = "hidden";
            }
            function clic_recuperar() {
                var formularioRecuperar = document.getElementById("formulario_recuperar");
                var formularioEntrar = document.getElementById("formulario_entrar");
                var formularioRegistrar = document.getElementById("formulario_registrar");
				formularioEntrar.style.visibility = "hidden";
				formularioRegistrar.style.visibility = "hidden";
                formularioRecuperar.style.visibility = "visible";
            }
            function clic_registrar() {
                var formularioRecuperar = document.getElementById("formulario_recuperar");
                var formularioEntrar = document.getElementById("formulario_entrar");
                var formularioRegistrar = document.getElementById("formulario_registrar");
				formularioEntrar.style.visibility = "hidden";
                formularioRegistrar.style.visibility = 'visible';
                formularioRecuperar.style.visibility = "hidden";
            }
		</script>

<?php
	require 'login.php';
	if($id_user != ""){
		$sql = "SELECT `fiestas`.`id_fiesta` , `fiestas`.`descripcion`
			FROM `users_fiesta` , `fiestas`
			WHERE `users_fiesta`.`id_user` = " . $id_user . "
			AND `users_fiesta`.`id_fiesta` = `fiestas`.`id_fiesta`
			AND `fiestas`.`abierto` = '0' ORDER BY `users_fiesta`.`id_fiesta` DESC 
			LIMIT 0 , 3";
		$fiestas=$db->select_varios($sql);
		if(count($fiestas)==0){
			echo "<p>De momento no tienes ninguna fiesta activa</p>";		
		}else{
			echo "<p>Últimas fiestas abiertas:</p><ul>";
			while($row = mysql_fetch_array($fiestas)){
				$id_fiesta=$row['id_fiesta'];
				$pagado=0;
				$pagar=0;
		      echo "<li><a href=\"fiesta.php?id_fiesta=".$row['id_fiesta']."\">".$row['descripcion']."</a>";
			   $pagado = $pagado +pagado($id_user, $id_fiesta);
			   $pagar = $pagar + pagar($id_user, $id_fiesta);
			   if($id_user==creador_fiesta($id_fiesta)){
					echo " <a href=\"cerrar_fiesta.php?id_fiesta=".$id_fiesta."\"> cerrar</a>";
			   }
				echo "<br />Total pagado por ti: ".$pagado."€";
				echo "<br />Total a pagar: ".$pagar."€";
				echo "<br />Saldo: ".($pagar-$pagado)."€</li>";
				echo "Gente participando: ".num_gente($id_fiesta);
		   }
		   echo "</ul>";
		}
		require('pie.php');
	}
	else{
		?><p id="entrada">
		<a id ="enlace_entrar" href="#" onClick="clic_entrar();">Entrar</a><br />

		<form action="entrada.php" method="post" id="formulario_entrar">
			Usuario <input type="text" name="user" maxlength="255" size="10" value="" /><br />
			Contraseña <input type="password" id="password" name="password" maxlength="255" size="10" value="" /><br />
			<input type="submit" name="login" value="Entrar" />
		</form></p>
		<p id="recuperar">
        <a id ="enlace_recuperar" href="#" onClick="clic_recuperar();">Recuperar contraseña</a><br />
        <form action="recuperar.php" method="post" id="formulario_recuperar">
			Usuario <input type="text" name="user" maxlength="255" size="10" value="" /><br />
			Correo <input type="text" id="correo" name="correo" maxlength="255" size="10" value="" /><br />
			<input type="submit" name="login" value="Recuperar contraseña" />
		</form></p>
        <p id="registrar">
        <a id ="enlace_registrar" href="#" onClick="clic_registrar();">Registrar</a><br />
        <form action="registrar.php" method="post" id="formulario_registrar">
			Usuario <input type="text" name="user" maxlength="255" size="10" value="" /><br />
			Correo <input type="text" id="correo" name="correo" maxlength="255" size="10" value="" /><br />
			Contraseña <input type="password" id="password" name="password" maxlength="255" size="10" value="" /><br />
            <input type="submit" name="login" value="Registrar" />
		</form></p>
			<?
		require('pie.php');
	}
?>