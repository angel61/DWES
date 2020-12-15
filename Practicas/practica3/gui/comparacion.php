<?php
    $jugador1=getJugador($_SESSION['jugador'][0]);
    $jugador2=getJugador($_SESSION['jugador'][1]);
?>
<table>
    <?php
    $cont=0;
    foreach (array_combine($jugador1, $jugador2) as $elemento1 => $elemento2) {
        echo "<tr>";
        if ($cont>=5) {
            if ($elemento1>$elemento2) {
                echo "<td><b>".$elemento1."</b></td> <td>".$elemento2."</td>";
            } elseif ($elemento2>$elemento1) {
                echo "<td>".$elemento1."</td> <td><b>".$elemento2."</b></td>";
            } else {
                echo "<td>".$elemento1."</td> <td>".$elemento2."</td>";
            }
        } else {
            echo "<td>".$elemento1."</td> <td>".$elemento2."</td>";
        }
        echo "</tr>";
        $cont++;
    }
    ?>
</table>