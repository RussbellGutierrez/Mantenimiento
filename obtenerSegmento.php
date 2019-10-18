<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$opcion = filter_input(INPUT_POST, "opcion");
$anulado = filter_input(INPUT_POST, "anulado");
$orden = filter_input(INPUT_POST, "orden");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

switch($opcion){
	case 1:
	$sql = $query->getCategorias($orden,$anulado);
	$execute = sqlsrv_query($cadena,$sql);
	break;
	case 2:
	$sql = $query->getLineas($orden,$anulado);
	$execute = sqlsrv_query($cadena,$sql);
	break;
	case 3:
	$sql = $query->getGenericos($orden,$orden,$anulado);
	$execute = sqlsrv_query($cadena,$sql);
	break;
	case 4:
	$sql = $query->getFamilias($orden,$orden,$orden,$anulado);
	$execute = sqlsrv_query($cadena,$sql);
	break;
}
while ($datos = sqlsrv_fetch_array($execute)) {
	$row = array('id'=>$datos['id'],'descrip'=>$datos['descrip'],'anulado'=>$anulado);
	array_push($array,$row);
}
echo json_encode($array);