<?php
$resultado = 0;
$tipo = gettype($resultado);
echo "Resultado vale: $resultado y es de tipo $tipo<br>";
$resultado2 = (double)$resultado;
$tipo = gettype($resultado2);
echo "y Resultado2: $resultado2 y es de tipo $tipo<br>";
$tipo = gettype($resultado);
echo "mientras Resultado vale: $resultado y es de tipo $tipo<br>";
