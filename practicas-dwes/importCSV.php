<!DOCTYPE html>
<?php session_start();?>
<?php require_once("accdat/BBDD.php"); ?>
<html lang="es">

<head>
    <script type="text/javascript" src="js/eventos.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gui/estilo.css">
    <title>Proyecto UT2/UT3</title>
</head>

<body onload="onLoad_body();">

    <?php require_once("gui/cabecera.php"); 
    $seccion="Importar CSV";
    require_once("gui/acceso_contenido.php"); 
    ?>
    <div class="contenido">
    <?php
        if (acceso(tipoAcceso[0])) {
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
    

</body>

</html>