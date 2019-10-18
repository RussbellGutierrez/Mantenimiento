<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$id = filter_input(INPUT_POST, "id");
$segmento = filter_input(INPUT_POST,"segmento");
$anular = filter_input(INPUT_POST,"anular");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

//$item = explode('@', $parametros);

switch (intval($segmento)) {
	case 1:
		$sql = $query->anularHabilitarCategoria($id,$anular);
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 2:
		$sql = $query->anularHabilitarLinea($id,$anular);
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 3:
		$sql = $query->anularHabilitarGenerico($id,$anular);
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 4:
		$sql = $query->anularHabilitarFamilia($id,$anular);
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
}
if ($anular == 1) {
	$sql = $query->anularSegmentoArticulo($id,$segmento);
	$ejecutar = sqlsrv_query($cadena,$sql);	
	if ($ejecutar === false) {
		$respuesta = "error";
	}else{
		$respuesta = "success";
	}
}
echo $respuesta;