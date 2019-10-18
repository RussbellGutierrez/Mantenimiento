<?php

/**
 * Clase encargada de manejar los errores provenientes de SQL server
 */
setlocale(LC_ALL,"es_ES"); ///Adicion
date_default_timezone_set("America/Lima");

class Metodos{
    
    function __construct(){}

    #Devuelve la conexion dependiendo de la base de datos
    function getConexion($conexion,$basedatos) {
        return (strcasecmp($basedatos, 'oriunda') == 0) ? $conexion->conectOri() : $conexion->conectTerra();
    }

    function revisarResultado($marca,$basedatos){
        $fecha = date("d-m-Y");
        $ok = "logs/".$basedatos."/ok_".$marca.".txt";
        $error = "logs/".$basedatos."/error_".$marca."_".$fecha.".txt";
        if (file_exists($ok) && file_exists($error)) {
            unlink($ok);
            echo "warning";
        }elseif (!file_exists($ok) && file_exists($error)) {
            echo "error";
        }elseif (file_exists($ok) && !file_exists($error)) {
            unlink($ok);
            echo "success";
        }
    }

    function in_array_recursivo($parametro, $multidimensional, $estricto = false) {
        foreach ($multidimensional as $item) {
            if (($estricto ? $item === $parametro : $item == $parametro) || (is_array($item) && in_array($parametro, $item, $estricto))) {
                return true;
            }
        }
        return false;
    }

    function value_recursivo($parametro, $multidimensional, $estricto = false) {
        $item = 0;
        foreach ($multidimensional as $item) {
            if (($estricto ? $item === $parametro : $item == $parametro) || (is_array($item) && in_array($parametro, $item, $estricto))) {
                return $item;
            }
        }
        return $item;
    }

    function scan_dir($dir) {
        $ignored = array('.', '..', '.svn', '.htaccess');

        $files = array();    
        foreach (scandir($dir) as $file) {
            if (in_array($file, $ignored)) continue;
            $files[$file] = filemtime($dir . '/' . $file);
        }

        arsort($files);
        $files = array_keys($files);

        return ($files) ? $files : false;
    }

    function consultaError($empresa,$marca,$error){
        $hora = date("h:i:sa");
        $fecha = date("d-m-Y");
        $archivo = "error_".$marca."_".$fecha.".txt";
        $carpeta = "logs/".$empresa."/".$archivo;
        $texto = "Base de datos -> ".$empresa."<br>Marca ->".$marca."<br>Fecha y Hora ->".$fecha." ".$hora."<br>########## Error ##########<br>SQLSTATE: ".$error[ 'SQLSTATE']."<br>code: ".$error[ 'code']."<br>message: ".$error[ 'message']."<br><br>";

        #funcion que permite escribir texto dentro de un archivo .txt
        $file = file_put_contents($carpeta, $texto.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    function consultaCorrecta($basedatos,$marca,$linea,$articulo){
        $archivo = "ok_".$marca.".txt";
        $carpeta = "logs/".$basedatos."/".$archivo;
        $texto = "Marca -> ".$marca." ::: Linea -> ".$linea ." ::: Articulo -> ".$articulo ." -> OK <br><br>";

        #funcion que permite escribir texto dentro de un archivo .txt
        $file = file_put_contents($carpeta, $texto.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    function consultarRegistro($basedatos,$archivo){
        $carpeta = "logs/".$basedatos."/".$archivo;

        #funcion que permite obtener texto dentro de un archivo .txt
        $file = file_get_contents($carpeta);
        return $file;
    }

    function crearCookie($key,$value,$long = false){
        $cookie_key = $key;
        $cookie_value = $value;
        setcookie($cookie_key,base64_encode($cookie_value),0,"/"); //hasta cerrar el navegador
    } 
}