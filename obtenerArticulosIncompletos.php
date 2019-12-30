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
$sql = $query->getArticulosIncompletos();
$execute = sqlsrv_query($cadena,$sql);
while ($datos = sqlsrv_fetch_array($execute)) {
	$row = array('marca'=>$datos['marca'],'articulo'=>$datos['articulo'],'nomart'=>$datos['nomart'],'categoria'=>$datos['categoria'],'nomcat'=>$datos['nomcat'],'linea'=>$datos['linea'],'nomlin'=>$datos['nomlin'],'generico'=>$datos['generico'],'nomgen'=>$datos['nomgen'],'familia'=>$datos['familia'],'nomfam'=>$datos['nomfam'],'orden'=>$datos['orden'],'factor'=>$datos['factor'],'anulado'=>$datos['anulado']);
	array_push($array, $row);
}

echo json_encode($array);