<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");
$opcion = filter_input(INPUT_POST,"opcion");
$familia = filter_input(INPUT_POST, "familia");
$parametros = filter_input(INPUT_POST,"parametros");

$array = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

$param_fam = explode('@',$familia);
$param_datos = explode('@',$parametros);

switch ($opcion) {
	case 1:
		$articulo = $query->actualizarPosicion($param_datos[0],$param_datos[2]);
		$exec = sqlsrv_query($cadena,$articulo);
		if (intval($param_datos[1]) < intval($param_datos[2])) {
			$inicio = intval($param_datos[1]);
			$fin = intval($param_datos[2]);
			$orden = 'abajo';
		}else{
			$inicio = intval($param_datos[2]);
			$fin = intval($param_datos[1]);
			$orden = 'arriba';
		}
		$get = $query->getListaOrdenar($param_fam[2],$param_fam[0],$param_datos[0],$inicio,$fin);
		$exec = sqlsrv_query($cadena,$get);
		while ($dato = sqlsrv_fetch_array($exec)) {
			if ($orden == 'abajo') {
				$pos = intval($dato['orden']) - 1;
				$sql = $query->actualizarPosicion($dato['codart'],$pos);
				sqlsrv_query($cadena,$sql);
			}else{
				$pos = intval($dato['orden']) + 1;
				$sql = $query->actualizarPosicion($dato['codart'],$pos);
				sqlsrv_query($cadena,$sql);
			}
		}
		break;

	case 2:
		$get = $query->getPosicion($param_fam[2],$param_fam[0],$param_datos[2]);
		$exec = sqlsrv_query($cadena,$get);
		while ($dato = sqlsrv_fetch_array($exec)) {

			$articulo_origen = $query->actualizarPosicion($param_datos[0],$dato['orden']);
			$exec = sqlsrv_query($cadena,$articulo_origen);
			$articulo_destino = $query->actualizarPosicion($dato['codart'],$param_datos[1]);
			sqlsrv_query($cadena,$articulo_destino);
		}
		break;
	
	default:
		break;
}