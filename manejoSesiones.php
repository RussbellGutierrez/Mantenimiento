<?php
require_once 'metodos.php';

$parametro = filter_input(INPUT_POST, "parametro");

$metodos = new Metodos;
if (intval($parametro) == 1) {
	$metodos->crearCookie("_seb","oriunda"); 
}elseif (intval($parametro == 2)){
	$metodos->crearCookie("_seb","terranorte"); 
}elseif (intval($parametro == 3)){
	$metodos->crearCookie("_rac","oriunda");
}elseif (intval($parametro == 4)){
	$metodos->crearCookie("_rac","terranorte"); 
}