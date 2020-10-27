<?php
$num1 = 5.5;
$num2 = &$num1;
echo "<br>num1: $num1 - num2: $num2";
echo "<br>Existe la variable num1: ";
var_dump(isset($num1));
echo "<br>Esta vacía la variable num1: ";
var_dump(empty($num1));
echo "<br>Es de tipo entero la variable num1: ";
var_dump(is_int($num1));
echo "<br>Es de tipo real la variable num1: ";
var_dump(is_real($num1));
unset ($num1);
echo "<br>Existe la variable num1: ";
var_dump(isset($num1));
echo "<br>Existe la variable num2: ";
var_dump(isset($num2));
echo "<br>num1: $num1 - num2: $num2"; 