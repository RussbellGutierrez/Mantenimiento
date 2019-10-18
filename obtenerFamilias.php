<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$generico = filter_input(INPUT_POST, "generico");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

$item = explode('@', $generico);
$sql = $query->getFamilias($item[3],$item[2],$item[0]);
$execute = sqlsrv_query($cadena,$sql);

while($datos = sqlsrv_fetch_array($execute)){

	$row = array('id'=>$datos['id'],'descrip'=>$datos['descrip'],'generico'=>$datos['generico']);
	array_push($array, $row);
}
echo json_encode($array);