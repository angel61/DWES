<?php
ini_set("soap.wsdl_cache_enbled","0");
$server=new SoapServer("aritmetica.wsdl");

function sumar($operando1,$operando2){
    return $operando1+$operando2;
}
function restar($operando1,$operando2){
    return $operando1-$operando2;
}

$server->addFunction("sumar");
$server->addFunction("restar");
$server->handle();
?>