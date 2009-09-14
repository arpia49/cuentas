<?php
	require('cabecera.php');
	$id_user=$_SESSION['user_logged'];
	$correo=$_POST['correo'];
	$id_fiesta=$_POST['id_fiesta'];
	$id_user_correo=id_user_correo($correo);
	if($id_fiesta!=""){
		if($id_user_correo == 0){
			echo "<p>El usuario no existe</p>";
		}
		else{
			insertar_usuario_fiesta($id_user_correo, $id_fiesta);
			$rondas_fiesta=rondas_fiesta($id_fiesta);
			while($row = mysql_fetch_array($rondas_fiesta)){
				$id_ronda=$row['id_ronda'];
				insertar_usuario_rondas($id_user_correo, $id_ronda);
			}
			echo "<p>Usuario añadido a la fiesta</p>";
		}
		echo "<p><a href=\"crear_amigos.php?id_fiesta=".$id_fiesta."\">Añadir más amigos</a><br />";
		echo "<a href=\"fiesta.php?id_fiesta=".$id_fiesta."\">Ir a los cálculos de la fiesta</a></p>";
	}else{
		if($id_user_correo == 0){
			echo "<p>El usuario no existe</p>";
		}
		else{
			insertar_amigo($id_user, $id_user_correo);
			echo "<p>Amigo añadido.</p>";
			$mis_amigos=mis_amigos($id_user);
			echo "<h2>Tu lista de amigos</h2><ul>";
			while($row = mysql_fetch_array($mis_amigos[0])){
				if($row['id_user1']!=$id_user){
					echo "<li>".user($row['id_user1'])."</li>";
				}else{
					echo "<li>".user($row['id_user2'])."</li>";
				}
			}
		}
		echo "</ul>";
		echo "<p><a href=\"nuevos_amigos.php\">Añadir más amigos</a></p>";
	}
	require('pie.php');	
?>