<?php
	require('cabecera.php');
	$id_user=$_SESSION['user_logged'];
	$id_fiesta=$_GET['id_fiesta'];
		?>
	<form action="procesar_fiesta.php" method="post">
		<!-- ¿Mejor un textarea? -->
		<p>Descripción de la fiesta:<input type="text" name="descripcion" maxlength="255" />
		<button name="enviar" value="Enviar" type="submit">Enviar</button></p>
	</form>
		<?php
			require('pie.php');
		?>