<?php
require_once("nusoap/lib/nusoap.php");

$cliente = new nusoap_client("http://localhost/DWES/Practicas/practica_UT5/Server_nusoapP5.php?wsdl");

$error = $cliente->getError();
if ($error){
    echo "Error: $error";
}

$usuario=$_REQUEST['usuario']??'';
$pass=$_REQUEST['pass']??'';

//Servicio login
$res = $cliente->call("loginMiServicio", ['usuario' => $usuario, 'pass' => $pass]);
$error = $cliente->getError();
if ($error){
    echo "Error: $error";
} else {
    echo($res);//echo "Resultado date: $res<br>";
}
