<?php
	require('cabecera.php');
	$id_user=$_SESSION['user_logged'];
	$id_fiesta=$_GET['id_fiesta'];
	if(estado($id_fiesta)==1){
		echo "Esta fiesta está cerrada.";
	}else{
?>
	<form action="procesar_ronda.php" method="post">
		<!-- ¿Mejor un textarea? -->
		<p>Descripción de la ronda:<input type="text" name="descripcion" maxlength="255" />
		<br />Precio de la ronda (la has pagado tú):<input type="text" name="precio" maxlength="13" size="13" />
		<?php
			echo "<input type=\"hidden\" name=\"id_fiesta\" value=\"".$id_fiesta."\" />";
		?>
		<br /><button name="enviar" value="Enviar" type="submit">Enviar</button></p>
	</form>
<?php
	}
        echo "<br /><a href=\"fiesta.php?id_fiesta=" . $id_fiesta . "\">Volver a la fiesta</a>";
	require('pie.php');
?>