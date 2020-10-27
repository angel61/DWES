<?php
echo "<table border=\"1px\">";

$filas=intval($_POST["fil"]);
$columnas=intval($_POST["col"]);
$cont=0;

for($i=0;$i<$filas;$i++){
    echo "<tr>";
    for($u=0;$u<$columnas;$u++){
        ++$cont;
        echo "<td>$cont</td>";
    }
    echo "</tr>";
}
echo "</table>";