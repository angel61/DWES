<?php
    $equipos[0]=getEquipos($_SESSION['conferencia'][0]);
    $equipos[1]=getEquipos($_SESSION['conferencia'][1]);
?>
<form id="frmEquipo" action="index.php" method="post">

    <select name="slcEquipoJ1">
        <?php
        foreach ($equipos[0] as $elemento) {
            echo "<option>".$elemento."</option>";
        }
    ?>
    </select>
    <select name="slcEquipoJ2">
        <?php
        foreach ($equipos[1] as $elemento) {
            echo "<option>".$elemento."</option>";
        }
    ?>
    </select>
    <input type="submit">
</form>