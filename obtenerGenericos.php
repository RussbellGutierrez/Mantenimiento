<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$linea = filter_input(INPUT_POST, "linea");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

$item = explode('@', $linea);
$sql = $query->getGenericos($item[2],$item[0]);
$execute = sqlsrv_query($cadena,$sql);
while ($datos = sqlsrv_fetch_array($execute)) {
	$row = array('id'=>$datos['id'],'descrip'=>$datos['descrip'],'linea'=>$datos['linea']);
	array_push($array, $row);
}
echo json_encode($array);