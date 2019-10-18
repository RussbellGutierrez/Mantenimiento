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
$orden = 1;

while($datos = sqlsrv_fetch_array($execute)){

	if (!in_array($datos['articulo'], $array)) {

		$posicionar = $query->actualizarPosicion($datos['articulo'],$orden);
		$exe = sqlsrv_query($cadena,$posicionar);
		array_push($array,$datos['articulo']);

		$orden++;
	}
}