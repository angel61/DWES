<?php
$resultado = 0.00;
$tipo = gettype($resultado);
echo "Resultado vale: $resultado y es de tipo $tipo<br>";
$resultado = "Cero";
$tipo = gettype($resultado);
echo "y ahora vale: $resultado y es de tipo $tipo<br>"; 

?>