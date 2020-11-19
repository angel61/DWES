<?php
    $jugadores[0]=getJugadores($_SESSION['equipo'][0]);
    $jugadores[1]=getJugadores($_SESSION['equipo'][1]);
?>
<form id="frmJugador" action="index.php" method="post">

    <select name="slcJ1">
        <?php
        foreach ($jugadores[0] as $clave => $elemento) {
            echo "<option value=\"".$clave."\">".$elemento."</option>";
        }
        ?>
    </select>
    <select name="slcJ2">
        <?php
        foreach ($jugadores[1] as $clave => $elemento) {
            echo "<option value=\"".$clave."\">".$elemento."</option>";
        }
        ?>
    </select>
    <input type="submit">
</form>