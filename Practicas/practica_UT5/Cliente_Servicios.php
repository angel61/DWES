<?php
require_once("nusoap/lib/nusoap.php");

$cliente = new nusoap_client("http://localhost/DWES/Practicas/practica_UT5/Server_nusoapP5.php?wsdl");

$error = $cliente->getError();
if ($error){
    echo "Error: $error";
}

$token='nada';
if(isset($_REQUEST["token"]))
    $token=$_REQUEST["token"];

//Servicio date
$res = $cliente->call("dateMiServicio", ['token' => $token]);
$error = $cliente->getError();
if ($error){
    echo "Error: $error";
} else {
    echo "Resultado date: $res<br>";
}

//Servicio echo
$res = $cliente->call("echoMiServicio", ['token' => $token, 'repuesta' => 'abc']);
$error = $cliente->getError();
if ($error){
    echo "Error: $error";
} else {
    echo "Resultado echo: $res<br>";
}
