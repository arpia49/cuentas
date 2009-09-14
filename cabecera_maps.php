<?php
	require('libs/funciones.php');
	conectar();
	$db=new DB();
	session_start();
	$id_user=$_SESSION['user_logged'];
	if($id_user==""){
		header("location: index.php"); 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	   <title>Gestor de cuentas</title>
	   <meta http-equiv="Content-Type"
	    content="text/html; charset=utf-8" />
	    <link rel="stylesheet" type="text/css" media="screen" href="libs/estilo.css" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAK-EFNFMO_0XmjojhacSOxBTqEbIssWsfvxnA2uIwG3iZaVu0IBSmzWESXk7eBPacMnNVfvWtc3mYJg"
      type="text/javascript"></script>
    <script type="text/javascript">

    //<![CDATA[

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas"));
        var geocoder = new GClientGeocoder();
        geocoder.getLatLng(
          "madrid",
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
              map.setCenter(point, 13);
            }
          }
        );
      }
    }

    //]]>
    </script>
  </head>
	</head>
	<body onload="load()" onunload="GUnload()">
		<div id="cabecera">
			<a href=".">
				<img src="imagenes/logo.png" alt="Logo de la web" />
			De rondas</a>
		</div>
<?php
	require 'login.php';
?>
