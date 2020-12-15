<?php 
$num1=$_POST["numero1"];
$num2=$_POST["numero2"];
$operacion=$_POST["operacion"];
#echo $num1 . $num2 . $operacion;

$resultado;
if($operacion=="sumar"){
    $resultado=$num1+$num2;
}elseif($operacion=="restar"){
    $resultado=$num1-$num2;
}elseif($operacion=="multiplicacion"){
    $resultado=$num1*$num2;
}elseif($operacion=="division"){
    $resultado=$num1/$num2;
}elseif($operacion=="modulo"){
    $resultado=$num1%$num2;
}

echo $resultado;