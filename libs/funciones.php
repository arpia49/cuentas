<?php
require ('config.php');

class DB {
	function DB(){
		$conn = mysql_connect(SQL_HOST, SQL_USER, SQL_PASS) or die("Error en la conexión de la base de datos");
		mysql_select_db(SQL_DB, $conn);
	}
	function select_varios($sql){
		$resultado = mysql_query($sql) or die(mysql_error());
		return $resultado;
	}
	function select_simple($sql){
		$resultado = mysql_fetch_row(mysql_query($sql) or die(mysql_error()));
		return $resultado[0];
	}
	function select_unico($sql){
		$res = mysql_query($sql) or die(mysql_error());
		$resultado = mysql_fetch_row($res);
		return $resultado[0];
	}
	function update($sql){
		$resultado = mysql_query($sql) or die(mysql_error());
		return $resultado;
	}
}

function amigos_gmail($amigos_gmail){
	$sql="SELECT `id_user` FROM `users` WHERE `correo` = ";	
	foreach ($amigos_gmail as $key => $value) {
		if($value!="Enviar"){
			$sql=$sql."'".addslashes(trim($value))."'". " or `correo` = ";
		}
	}
  	$sql = trim($sql," or `correo` = ");
	$result = mysql_query($sql) or die(mysql_error());
	return $result;
}

//de momento la dejamos
function cambiar($id_user, $id_ronda, $valor) {
	$sql = "UPDATE `users_ronda` SET `marcado` = '" . $valor . "' WHERE `id_user` ='" . $id_user . "' AND `id_ronda` = '" . $id_ronda . "'";
	$result = mysql_query($sql) or die(mysql_error());
	$users_ronda = users_ronda($id_ronda);
	$a_pagar=pagar_ronda($id_ronda);
	while ($row = mysql_fetch_array($users_ronda)) {
		$sql = "UPDATE `users_ronda` SET `saldo` = '" . $a_pagar . "' WHERE `id_user` ='" . $row['id_user'] . "' AND `id_ronda` = '" . $id_ronda . "' AND `marcado`=1";
		$result = mysql_query($sql) or die(mysql_error());
	}
}

function cambiar_saldo($id_user, $id_ronda, $saldo){
	$sql = "UPDATE `users_ronda` SET `saldo` = '" . $saldo . "' WHERE `id_user` ='" . $id_user . "' AND `id_ronda` = '" . $id_ronda . "'";
	$result = mysql_query($sql) or die(mysql_error());
	
}

function comprobar($user) {
	$sql = "SELECT pass FROM `users` WHERE `user` = '" . $user . "'";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function comprobar_user_correo($user, $correo) {
	$sql = "SELECT pass FROM `users` WHERE `user` = '" . $user . "' and `correo` = '".$correo."'";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function conectar() {
	$conn = mysql_connect(SQL_HOST, SQL_USER, SQL_PASS) or die("Error en la conexión de la base de datos");
	mysql_select_db(SQL_DB, $conn);
}

function creador_fiesta($id_fiesta) {
	$sql = "SELECT `id_user` FROM `fiestas` WHERE `id_fiesta` = '" . $id_fiesta ."'";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function crear_fiesta($id_user, $descripcion) {
	$sql = "INSERT INTO  `fiestas` (
		`id_fiesta` ,
		`id_user` ,
		`descripcion`
		)
		VALUES('','" . $id_user . "','" . $descripcion . "')";
	$result = mysql_query($sql) or die(mysql_error());
	$id_fiesta = mysql_insert_id();
	insertar_usuario_fiesta($id_user, $id_fiesta);
	return $id_fiesta;
}

function crear_ronda($id_user, $descripcion, $precio, $id_fiesta) {
	$sql = "INSERT INTO  `rondas` (`id_ronda` ,`id_user` ,`desc` ,`precio`)
		VALUES('','" . $id_user . "','" . $descripcion . "', '" . $precio . "')";
	$result = mysql_query($sql) or die(mysql_error());
	$id_ronda = mysql_insert_id();
	$sql = "INSERT INTO  `rondas_fiesta` (`id_ronda` ,`id_fiesta`)
		VALUES('" . $id_ronda . "', '" . $id_fiesta . "')";
	$result = mysql_query($sql) or die(mysql_error());
	//sacar todos los usuarios de una fiesta		
	$users_fiesta = users_fiesta($id_fiesta);
	while ($row = mysql_fetch_array($users_fiesta)) {
		$id_user = $row['id_user'];
		insertar_usuario_ronda_nueva($id_user, $id_ronda, $id_fiesta,$precio);
	}
}

function desc_fiesta($id_fiesta) {
	$sql = "SELECT `descripcion`  FROM `fiestas` WHERE `id_fiesta` = '" . $id_fiesta . "'";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function desc_rondas($id_fiesta) {
	$sql = "SELECT `desc`, `rondas`.`id_ronda`
			FROM `rondas_fiesta` , `rondas`
			WHERE `rondas_fiesta`.`id_ronda` = `rondas`.`id_ronda`
			AND `id_fiesta` = '" . $id_fiesta . "'";
	$resultado = mysql_query($sql) or die(mysql_error());
	return $resultado;
}

function desc_ronda($id_ronda) {
	$sql = "SELECT `desc` FROM `rondas` WHERE `id_ronda` = '" . $id_ronda . "'";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function es_amigo($id_user, $amigo) {
	$mis_amigos = mis_amigos($id_user);
	$lista_amigos=array();
	while ($row = mysql_fetch_array($mis_amigos[0])) {
		if ($row['id_user1'] != $id_user) {
			array_push($lista_amigos, $row['id_user1']);
		} else {
			array_push($lista_amigos, $row['id_user2']);
		}
	}
	$es_amigo=0;	
	foreach ($lista_amigos as $id_amigo) {
		if($id_amigo==$amigo || $amigo==$id_user){
			$es_amigo=1;
		}
	}
	return $es_amigo;
}

function estado($id_fiesta){
	$sql = "SELECT `abierto` FROM `fiestas` WHERE `id_fiesta` = " . $id_fiesta;
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function fiestas_juntos($id_user1, $id_user2){
	$sql = "SELECT count(*)/2 as kk FROM `users_fiesta` where id_user=".$id_user1." or id_user=".$id_user2." group by id_fiesta";
	$resultado = mysql_query($sql) or die(mysql_error());
	$veces=0;
	while ($row = mysql_fetch_array($resultado)) {
		if($row['kk']==1){
			$veces++;
		}
	}
	return $veces;
}

function fiestas_user($id_user) {
	$sql = "SELECT `id_fiesta` , `descripcion` FROM `fiestas` WHERE `id_user` = " . $id_user . " ORDER BY `fiestas`.`id_fiesta` DESC";
	$resultado = mysql_query($sql) or die(mysql_error());
	return $resultado;
}

//SE PUEDE BORRAR?
function id_user($user){
	$sql = "SELECT `id_user` FROM `users` WHERE `user` = '" . $user . "'";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function id_user_correo($correo){
	$sql = "SELECT `id_user` FROM `users` WHERE `correo` = '" . $correo . "'";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	if ($resultado == "") {
		$devolver = 0;
	} else {
		$devolver = $resultado[0];
	}
	return $devolver;
}

function insertar_amigo($id_user, $id_user_correo) {
	$sql = "INSERT INTO `amigos` ( `id_user1` , `id_user2` ) VALUES ( '" . $id_user . "', '" . $id_user_correo . "')";
	$result = mysql_query($sql) or die(mysql_error());
}

function insertar_usuario_fiesta($id_user, $id_fiesta) {
	$sql = "INSERT INTO `users_fiesta` ( `id_user` , `id_fiesta` ) VALUES ( '" . $id_user . "', '" . $id_fiesta . "' )";
	$result = mysql_query($sql) or die(mysql_error());
}

function insertar_usuario_ronda_nueva($id_user, $id_ronda, $id_fiesta, $precio) {
	$sql = "INSERT INTO `users_ronda` ( `id_user` , `id_ronda` , `marcado`, `saldo` ) VALUES ( '" . $id_user . "', '" . $id_ronda . "','1','".$precio / num_gente($id_fiesta)."')";
	$result = mysql_query($sql) or die(mysql_error());
}


function insertar_usuario_rondas($id_user, $id_ronda) {
	$saldo=pagar_ronda($id_ronda);
	$sql = "INSERT INTO `users_ronda` ( `id_user` , `id_ronda` , `marcado`, `saldo` ) VALUES ( '" . $id_user . "', '" . $id_ronda . "','1','".$saldo."')";
	$result = mysql_query($sql) or die(mysql_error());
}

function mi_saldo($id_user, $id_ronda) {
	$sql = "SELECT `saldo`
			FROM `users_ronda`
			WHERE `id_user` = " . $id_user . "
			AND `id_ronda` = " . $id_ronda;
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function mis_amigos($id_user) {
	$sql = "SELECT *
			FROM `amigos`
			WHERE `id_user1` = " . $id_user;
	$resultado = mysql_query($sql) or die(mysql_error());
	$filas = mysql_affected_rows();
	return array (
		$resultado,
		$filas
	);
}

function mis_fiestas($id_user) {
	$sql = "SELECT `fiestas`.`id_fiesta` , `fiestas`.`descripcion`
			FROM `users_fiesta` , `fiestas`
			WHERE `users_fiesta`.`id_user` = " . $id_user . "
			AND `users_fiesta`.`id_fiesta` = `fiestas`.`id_fiesta`
			ORDER BY `users_fiesta`.`id_fiesta` DESC";
	$resultado = mysql_query($sql) or die(mysql_error());
	return $resultado;
}

function mis_fiestas_abiertas($id_user) {
	$sql = "SELECT `fiestas`.`id_fiesta` , `fiestas`.`descripcion`
			FROM `users_fiesta` , `fiestas`
			WHERE `users_fiesta`.`id_user` = " . $id_user . "
			AND `users_fiesta`.`id_fiesta` = `fiestas`.`id_fiesta`
			AND `fiestas`.`abierto` = '0' ORDER BY `users_fiesta`.`id_fiesta` DESC";
	$resultado = mysql_query($sql) or die(mysql_error());
	return $resultado;
}

function num_gente($id_fiesta) {
	$sql = "SELECT count(*) FROM `users_fiesta` WHERE `id_fiesta` = ".$id_fiesta;
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function num_rondas($id_user) {
	$sql = " SELECT COUNT(*) FROM `users_ronda` WHERE `id_user` = " . $id_user;
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function pagado($id_user, $id_fiesta) {
	$sql = "SELECT SUM( precio )
		FROM `rondas_fiesta` , `rondas`
		WHERE `rondas_fiesta`.`id_ronda` = `rondas`.`id_ronda`
		AND `id_fiesta` = '" . $id_fiesta . "'
		AND `id_user` = '" . $id_user . "' ";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function pagar($id_user, $id_fiesta) {
	$rondas = rondas_fiesta_user($id_user, $id_fiesta);
	$total = 0;
	while ($row = mysql_fetch_array($rondas)) {
		if ($row['marcado'] == 1) {
			$total = $total +pagar_ronda($row['id_ronda']);
		}
	}
	return $total;
}

function pagar_ronda($id_ronda) {
	$resultado = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `users_ronda` WHERE `id_ronda` = '" . $id_ronda . "' AND `marcado`=1"));
	$gente = $resultado[0];
	$resultado = mysql_fetch_row(mysql_query("SELECT `precio` FROM `rondas` WHERE `id_ronda` = '" . $id_ronda . "'"));
	return $resultado[0] / $gente;
}

function registrar($user, $pass, $correo) {
	$sql = "INSERT INTO  `users` (
		`id_user` ,
		`user` ,
		`pass` ,
		`correo`
		)
		VALUES('','" . $user . "','" . $pass . "','" . $correo . "')";
	$result = mysql_query($sql) or die(mysql_error());
}

function rondas_fiesta($id_fiesta) {
	$sql = "SELECT `id_ronda`
			FROM `rondas_fiesta`
			WHERE `id_fiesta` = '" . $id_fiesta . "'";
	$resultado = mysql_query($sql) or die(mysql_error());
	return $resultado;
}

//SPB?
//creo que ahora que guardo users_ronda, esto se puede optimizar
function rondas_fiesta_user($id_user, $id_fiesta) {
	$sql = "SELECT `users_ronda`.`id_ronda` , `marcado`
			FROM `rondas_fiesta` , `users_ronda`
			WHERE `rondas_fiesta`.`id_ronda` = `users_ronda`.`id_ronda`
			AND `id_fiesta` = '" . $id_fiesta . "'
			AND `id_user` = '" . $id_user . "'
			GROUP BY `rondas_fiesta`.`id_ronda`";
	$resultado = mysql_query($sql) or die(mysql_error());
	return $resultado;
}

function user($id_user) {
	$sql = "SELECT `user` FROM `users` WHERE `id_user` = '" . $id_user . "'";
	$res = mysql_query($sql) or die(mysql_error());
	$resultado = mysql_fetch_row($res);
	return $resultado[0];
}

function users_fiesta($id_fiesta) {
	$sql = "SELECT `id_user` FROM `users_fiesta` WHERE `id_fiesta` = '" . $id_fiesta . "' ORDER BY `id_user` ASC";
	$resultado = mysql_query($sql) or die(mysql_error());
	return $resultado;
}

function users_ronda($id_ronda) {
	$sql = "SELECT `id_user` , `marcado`, `saldo`
			FROM `users_ronda`
			WHERE `id_ronda` = '" . $id_ronda . "'";
	$resultado = mysql_query($sql) or die(mysql_error());
	return $resultado;
}

?>