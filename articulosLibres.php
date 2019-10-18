<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);
$sql = $query->getArticulosLibres();
$execute = sqlsrv_query($cadena,$sql);

while($datos = sqlsrv_fetch_array($execute)){
	if (strlen($datos['peso'])<4) {
		$datos['peso'] = '0'.$datos['peso'];
	}
	$falta = "";
	if (intval($datos['categoria']) == 0) {
		$falta .= "C";
	}
	if (intval($datos['linea']) == 0) {
		$falta .= "L";
	}
	if (intval($datos['generico']) == 0) {
		$falta .= "G";
	}
	if (intval($datos['familia']) == 0) {
		$falta .= "F";
	}
	$row = array('articulo'=>$datos['articulo'],'descrip'=>$datos['descrip'],'presentacion'=>$datos['presentacion'],'peso'=>$datos['peso'],'orden'=>$datos['orden'],'categoria'=>$datos['categoria'],'linea'=>$datos['linea'],'generico'=>$datos['generico'],'familia'=>$datos['familia'],'falta'=>$falta,'factor'=>$datos['factor']);
	array_push($array,$row);
}

echo json_encode(array('data'=>$array));