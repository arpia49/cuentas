<?php
session_start();
require('libs/funciones.php');
conectar();

if(md5($_POST['password'])<> comprobar($_POST['user'])){
	echo "Contraseña no válida.<br />";
}
else{
	$id_user = id_user($_POST['user']);
	$_SESSION['user_logged'] = $id_user;
	echo"<script>parent.location.href=\"index.php\";</script>";
}
?>
