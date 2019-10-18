<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$dato = filter_input(INPUT_POST, "dato");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);
$item = explode('@', $dato);
$sql = $query->getArticulos($item[0],$item[1],$item[2],$item[3]);
$execute = sqlsrv_query($cadena,$sql);
while ($datos = sqlsrv_fetch_array($execute)) {
	if (strlen($datos['peso'])<4) {
		$datos['peso'] = '0'.$datos['peso'];
	}
	$row = array('articulo'=>$datos['articulo'],'descrip'=>$datos['descrip'],'presentacion'=>$datos['presentacion'],'ivadif'=>$datos['ivadif'],'peso'=>$datos['peso'],'orden'=>$datos['orden'],'categoria'=>$datos['categoria'],'linea'=>$datos['linea'],'generico'=>$datos['generico'],'familia'=>$datos['familia'],'factor'=>$datos['factor']);
	array_push($array,$row);
}

echo json_encode(array('data'=>$array));