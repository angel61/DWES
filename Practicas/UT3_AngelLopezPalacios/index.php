<!DOCTYPE html>
<?php
session_start();
require_once("accdat/BBDD.php");
require_once("funciones.php");
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 3 - Ángel López Palacios</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <?php
    switch (pasoActual()) {
        case "conferencias":
            require_once("gui/conferencias.php");break;
        case "equipos":
            require_once("gui/equipos.php");break;
        case "jugadores":
            require_once("gui/jugadores.php");break;
        case "comparacion":
            require_once("gui/comparacion.php");break;
    }
    ?>
</body>

</html>