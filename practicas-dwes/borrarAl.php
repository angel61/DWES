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
    $seccion="Borrar alumno";
    require_once("gui/contenido.php"); 
    ?>

</body>

</html>