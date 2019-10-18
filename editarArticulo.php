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

$item = explode('@', $parametros);
$sql = $query->articuloDescripcion($item[1]);
$ejecutar = sqlsrv_query($cadena,$sql);
while ($datos = sqlsrv_fetch_array($ejecutar)) {
	if ($datos['total'] == 0) {
		$sql = $query->setDescripcion($item[1],strtoupper($item[0]));
		$exe = sqlsrv_query($cadena,$sql);
	}else{
		$sql = $query->actualizarDescripcion($item[1],strtoupper($item[0]));
		$exe = sqlsrv_query($cadena,$sql);
	}
}
if ($exe) {
	$respuesta = 'success';
}else{
	$respuesta = 'error';
}
echo $respuesta;