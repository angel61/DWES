<?php
//Cliente
try{
    $cliente= new SoapClient('http://localhost/DWES/Practicas/practica_UT5/Server_Practica5.php?wsdl');
    $token=$cliente->loginMiServicio('a','a');
    echo "Token: ".$token."<br>";
    echo "Servicio echo: ".$cliente->echoMiServicio($token,"Servicio echo")."<br>";
    echo "Servicio date: ".$cliente->dateMiServicio($token)."<br>";
}catch(SoapFault $e){
    var_dump($e);
}