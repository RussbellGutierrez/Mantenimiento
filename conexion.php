<?php
class Conexion {

    function conectOri() {
        $serverName = "192.168.1.132";
        $connectionOri = array("Database" => "PEDIMAP_ORIUNDA", "UID" => "sistemas", "PWD" => "s1st3m4s", "CharacterSet" => "UTF-8");
        return $cono = sqlsrv_connect($serverName, $connectionOri);
    }

    function conectTerra() {
        $serverName = "192.168.1.132";
        $connectionTerra = array("Database" => "PEDIMAP_TN", "UID" => "sistemas", "PWD" => "s1st3m4s", "CharacterSet" => "UTF-8");
        return $cont = sqlsrv_connect($serverName, $connectionTerra);
    }

    function conectUsers() {
        $serverName = "192.168.1.132";
        $connectionTerra = array("Database" => "PEDIMAP_USERS", "UID" => "sistemas", "PWD" => "s1st3m4s", "CharacterSet" => "UTF-8");
        return $cont = sqlsrv_connect($serverName, $connectionTerra);
    }
}