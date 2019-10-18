<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$parametros = filter_input(INPUT_POST, "parametros");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);
$d = explode('@',$parametros);

$sql = $query->asignarFactor($d[0],$d[2]);
$ejecutar = sqlsrv_query($cadena,$sql);
if ($ejecutar === false) {
	$respuesta = "error";
}else{
	$respuesta = "success";
}
echo $respuesta;