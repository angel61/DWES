<?php
$jugador1 = getJugador($_SESSION['jugador'][0]);
$jugador2 = getJugador($_SESSION['jugador'][1]);
$filas=array("Nombre","Posicion","Nombre de equipo","Altura","Peso","Puntos","Asistencias","Tapones","Rebotes");
$puntos["J1"] = 0;
$puntos["J2"] = 0;
?>
<table>
    <?php
    for ($i=0;$i<count($filas);$i++) {
        echo "<tr>";
        echo "<th>".$filas[$i]."</th>";
        if ($i >= 5) {
            if ($jugador1[$i] > $jugador2[$i]) {
                echo "<td class=\"ganador\">" . $jugador1[$i] . "</td> <td>" . $jugador2[$i] . "</td>";
                $puntos["J1"]++;
            } elseif ($jugador2[$i] > $jugador1[$i]) {
                echo "<td>" . $jugador1[$i] . "</td> <td class=\"ganador\">" . $jugador2[$i] . "</td>";
                $puntos["J2"]++;
            } else {
                echo "<td>" . $jugador1[$i] . "</td> <td>" . $jugador2[$i] . "</td>";
            }
        } else {
            echo "<td>" . $jugador1[$i] . "</td> <td>" . $jugador2[$i] . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
<?php
if ($puntos["J1"] > $puntos["J2"]) {
    echo "<h1>GANADOR " . $jugador1[0] . "</h1>";
    echo "<h1>PERDEDOR " . $jugador2[0] . "</h1>";
} elseif ($puntos["J1"] < $puntos["J2"]) {
    echo "<h1>GANADOR " . $jugador2[0] . "</h1>";
    echo "<h1>PERDEDOR " . $jugador1[0] . "</h1>";
} else {
    echo "<h1>EMPATE</h1>";
}
?>