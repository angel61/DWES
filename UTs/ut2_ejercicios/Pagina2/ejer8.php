<?php
$num1 = 7;
$num2 = 5;

echo "Valor inicial 1: $num1 <br/>";
echo "Valor inicial 2: $num2 <br/> <br/>";

$result = $num1;
$result += $num2++; 
echo "El primer resultado seria: $result <br/>";
echo "Valor 1: $num1 <br/>";
echo "Valor 2: $num2 <br/> <br/>";

$result = &$num1;
$result += ++$num2;
echo "El segundo resultado seria: $result <br/>";
echo "Valor 1: $num1 <br/>";
echo "Valor 2: $num2 <br/> <br/>";

$result = &$num1;
$result += ++$num1;
echo "El tercer resultado seria: $result <br/>";
echo "Valor 1: $num1 <br/>";
echo "Valor 2: $num2 <br/>";