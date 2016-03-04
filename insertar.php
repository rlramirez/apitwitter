<?php 
include("dll/config.php");
include("dll/clase.php");
$miconexion = new DB_mysql;
$miconexion->conectar($dbname, $dbhost, $dbuname, $dbpass);
extract($_GET);
$nombre = $_GET['nombre'];
$fecha = $_GET['fecha'];
$user = $_GET['user'];
$rt = $_GET['rt'];
$tf = $_GET['tf'];

//Tue Mar 01 18:29:44 +0000 2016
$mes=substr($fecha,4,3);
$anio=substr($fecha,25,5);
$dia=substr($fecha,8,2);
$horas=substr($fecha,11,8);
$fecha2=$anio."-".$meses[$mes]."-".$dia." ".$horas;
$miconexion->consulta("insert into posts values('','$nombre','$fecha2','$user','$rt','$tf')");

?>