<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$opcion = filter_input(INPUT_POST,"opcion");
$datos = filter_input(INPUT_POST,"datos");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);
$d = explode('@',$datos);

switch ($opcion) {
	case 0:
		$sql = $query->asignarArticuloLibre($d[0],$d[1],$d[2],$d[3],$d[4]);
		$ejecutar = sqlsrv_query($cadena,$sql);
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 1:
		$sql = $query->asignarArticulo($d[0],$d[1],$d[2],$d[3],$d[4]);
		$ejecutar = sqlsrv_query($cadena,$sql);
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
}
echo $respuesta;