<?php
require_once("nusoap/lib/nusoap.php");
$server = new soap_server();
$ns = "test";
$server->configureWSDL('nuSOAP_SERVER', $ns);
$server->wsdl->schemaTargetNamespace = $ns;
$server->register('multiplicarNumeros', array('valor1' => 'xsd:integer', 'valor2' => 'xsd:integer'), array('return' => 'xsd:integer'), $ns);

function multiplicarNumeros($valor1, $valor2){
$res = $valor1 * $valor2;
return $res;
}

@$server->service(file_get_contents("php://input"));
?>
