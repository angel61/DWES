<?php
echo "<table border=\"1px\">";
$array=array($_POST["nombre"],$_POST["apellidos"],$_POST["telefono"],$_POST["direccion"],$_POST["poblacion"],$_POST["provincia"],$_POST["fecha"],$_POST["estudios"]);

foreach($array as &$valor){
    echo "<tr><td>$valor</td></tr>";
}
echo "</table";