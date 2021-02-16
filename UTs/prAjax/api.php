<?php
session_start();
include_once("ctes.php");
include_once ("bdconf.php");
include_once ("funciones.php");

$func = $_REQUEST['func']??0;
$ret = "";
switch($func){
    case LOGIN:
        $u = $_REQUEST['usuario']??"";
        $c = $_REQUEST['clave']??"";
        $ret = login($u, $c);
        header ("Content-Type:text/xml");
        break;
    case LOGOUT:
        $ret = logout();
        header ("Content-Type:text/xml");
        break;
    case SELECT:
        $ret = selectData();
        header ("Content-Type:text/json");
        break;
    case UPDATE:
        $ret = updateData();
        header ("Content-Type:text/json");
        break;
    case DELETE:
        $ret = deleteData();
        header ("Content-Type:text/json");
        break;
}

echo $ret;
?>
