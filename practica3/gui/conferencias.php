<?php
    $conferencias=getConferencias();
?>
<form id="frmConferencia" action="index.php" method="post">
    <select name="slcConfereciaJ1">
        <?php
                foreach ($conferencias as $elemento) {
                    echo "<option>".$elemento."</option>";
                }
            ?>
    </select>
    <select name="slcConfereciaJ2">
        <?php
                foreach ($conferencias as $elemento) {
                    echo "<option>".$elemento."</option>";
                }
            ?>
    </select>
    <input type="submit">
</form>