<?php
require_once 'conexion.php';
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$basedatos = filter_input(INPUT_POST, "basedatos");

$anular = array();
$habilitar = array();
$query = new Query;
$conexion = new Conexion;
$metodos = new Metodos;

$cadena = $metodos->getConexion($conexion,$basedatos);

$sql = $query->articulosAnuladosChess();
$ejecutar = sqlsrv_query($cadena,$sql);

while ($dato = sqlsrv_fetch_array($ejecutar)) {
	if ($dato['anulado'] == 1 || $dato['colector'] == 0) {
		array_push($anular,$dato);
	}else {
		array_push($habilitar,$dato);
	}
}

if (!empty($anular)) {
	foreach($anular as $v){
		$sql = $query->anularHabilitarArticulo(1,$v['articulo']);
		$ejecutar = sqlsrv_query($cadena,$sql);
	}
}

if (!empty($habilitar)) {
	foreach($habilitar as $j){
		$sql = $query->anularHabilitarArticulo(0,$j['articulo']);
		$ejecutar = sqlsrv_query($cadena,$sql);
	}
}