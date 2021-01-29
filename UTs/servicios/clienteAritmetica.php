<?php
try{
    $cliente= new SoapClient('http://localhost/DWES/UTs/servicios/AritmeticaServicio.php?wsdl');
    $resultadoSuma=$cliente->sumar(1,9);
    $resultadoResta=$cliente->restar(1,9);
    echo "Resultado de la suma:".$resultadoSuma."<br>Resultado de la resta:".$resultadoResta;
}catch(SoapFault $e){
    var_dump($e);
}
?>