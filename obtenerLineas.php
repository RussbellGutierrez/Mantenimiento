<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$categoria = filter_input(INPUT_POST, "categoria");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

$item = explode('@', $categoria);
$sql = $query->getLineas($item[0]);
$execute = sqlsrv_query($cadena,$sql);
while ($datos = sqlsrv_fetch_array($execute)) {
	$row = array('id'=>$datos['id'],'descrip'=>$datos['descrip'],'categoria'=>$datos['categoria']);
	array_push($array, $row);
}
echo json_encode($array);