<div class="contenido">
    <?php
        if (($usuAnt || validarUsuario($us, $pw))) {
    ?>
        <h2><?php echo $seccion?></h2>
    <?php
        } else {
    ?>
        <h3>No tienes acceso a esta seccion</h3>
        <a id="volver" href="index.php">Volver a la pagina de inicio</a>
    <?php
        }
    ?>
</div>