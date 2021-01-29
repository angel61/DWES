<?php
require_once("nusoap/lib/nusoap.php");

$cliente = new nusoap_client("http://localhost/DWES/UTs/servicios/Server_nusoap.php?wsdl");

$error = $cliente->getError();
if ($error){
    echo "Error: $error";
}

$res = $cliente->call("multiplicarNumeros", ["valor1" => "11", "valor2" => "15"]);
$error = $cliente->getError();
if ($error){
    echo "Error: $error";
} else {
    echo "Resultado: $res";
}
