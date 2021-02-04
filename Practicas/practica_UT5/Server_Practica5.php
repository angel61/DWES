<?php
//Servidor
require_once("nusoap/lib/nusoap.php");
$server = new soap_server();
$ns = "test";
$server->configureWSDL('nuSOAP_SERVER', $ns);
$server->wsdl->schemaTargetNamespace = $ns;

$server->register('loginMiServicio', array('usuario' => 'xsd:string', 'pass' => 'xsd:string'), array('return' => 'xsd:string'), $ns);
$server->register('echoMiServicio', array('token' => 'xsd:string', 'respuesta' => 'xsd:string'), array('return' => 'xsd:string'), $ns);
$server->register('dateMiServicio', array('token' => 'xsd:string'), array('return' => 'xsd:string'), $ns);

//Se hace include a la clase de base de datos
include_once("accdat/BBDD.php");

function loginMiServicio($usuario, $pass)
{
    $res = "Usuario o contraseña no valida";

    $token = sha1(microtime(true) . "-" . $usuario . "-" . $pass);

    $bbdd = new BBDD();
    $solucion = $bbdd->nuevoToken($token, $usuario, $pass);
    unset($bbdd);

    if ($solucion === 1)
        $res = $token;

    return $res;
}
function echoMiServicio($token, $respuesta)
{
    $retorno = "Token no valido";

    $bbdd = new BBDD();
    if ($bbdd->validarToken($token))
        $retorno = $respuesta;
    unset($bbdd);

    return $retorno;
}
function dateMiServicio($token)
{
    $retorno = "Token no valido";

    $bbdd = new BBDD();
    if ($bbdd->validarToken($token))
        $retorno = date("d-m-Y");
    unset($bbdd);

    return $retorno;
}

@$server->service(file_get_contents("php://input"));
