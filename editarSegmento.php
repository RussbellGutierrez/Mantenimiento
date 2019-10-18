<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$parametros = filter_input(INPUT_POST, "parametros");
$segmento = filter_input(INPUT_POST,"segmento");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

$item = explode('@', $parametros);

switch (intval($segmento)) {
	case 1:
		$sql = $query->descripcionCategoria($item[0],strtoupper($item[1]));
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 2:
		$sql = $query->descripcionLinea($item[0],strtoupper($item[1]));
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 3:
		$sql = $query->descripcionGenerico($item[0],strtoupper($item[1]));
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 4:
		$sql = $query->descripcionFamilia($item[0],strtoupper($item[1]));
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
}
echo $respuesta;