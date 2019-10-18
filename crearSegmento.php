<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$segmento = filter_input(INPUT_POST, "segmento");
$id = filter_input(INPUT_POST,"id");
$descripcion = filter_input(INPUT_POST, "descripcion");

$respuesta = "";
$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

switch (intval($segmento)) {
	case 1:
		$sql = $query->setCategoria($id,strtoupper($descripcion));
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 2:
		$sql = $query->setLinea($id,strtoupper($descripcion));
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 3:
		$sql = $query->setGenerico($id,strtoupper($descripcion));
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
	case 4:
		$sql = $query->setFamilia($id,strtoupper($descripcion));
		$ejecutar = sqlsrv_query($cadena,$sql);	
		if ($ejecutar === false) {
			$respuesta = "error";
		}else{
			$respuesta = "success";
		}
		break;
}
echo $respuesta;