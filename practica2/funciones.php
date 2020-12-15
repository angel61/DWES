<?php
# Se inicializan los valores antes de la partida
function inicializarSesion()
{
    unset($_SESSION['usuario']);
    unset($_SESSION['registro']);
    $_SESSION["preguntas"] = array();
    $_SESSION["cont"] = 0;
    $_SESSION["historico"] = array();
    $_SESSION["puntuacion"] = array();
    $_SESSION["puntuacion"]['ciencia'] = 0;
    $_SESSION["puntuacion"]['deporte'] = 0;
    $_SESSION["puntuacion"]['arte'] = 0;
    $_SESSION["puntuacion"]['historia'] = 0;
    $_SESSION["puntuacion"]['total'] = 0;
    $_SESSION["multiplicador"] = 1;
}

#Se comprueba si se termino la pregunta y se suman los puntos
function esFinDePartida()
{
    if ($_SESSION["cont"] > (count(($_SESSION["preguntas"])) - 1)) {
        $_SESSION['puntuacion']['total'] += 1000;
        header("Location: index.php");
        exit;
    }
}
