<?php

function editarPregunta($array)
{
    $fp = fopen('csv/preguntas.csv', 'a');
    fputcsv($fp, $array);
    fclose($fp);
}

function cargarPregunta()
{
    $cont= $_SESSION["cont"];
    if (count($_SESSION["preguntas"])<=0) {
        $fp = fopen('csv/preguntas.csv', 'r');
        while (($preg = fgetcsv($fp, 1000, ",")) !== false) {
            $_SESSION["preguntas"][]= $preg;
        }
        fclose($fp);
        shuffle($_SESSION["preguntas"]);
    }

    return $_SESSION["preguntas"][$cont];
}

function comrobarPregunta($respuesta, $pregunta)
{
    $comprobacion=$respuesta==$pregunta[7];
    return $comprobacion;
}

function leerTop()
{
    $top= [];
    $fp = fopen('csv/topJugadores.csv', 'r');
    while (($usuario = fgetcsv($fp, 1000, ",")) !== false) {
        $top[]= $usuario;
    }
    fclose($fp);
     
    return $top;
}

function ordenarTop($top)
{
    $puntuacion  = array_column($top, 0);
    $nombre = array_column($top, 1);

    array_multisort($puntuacion, SORT_DESC, $nombre, SORT_ASC, $top);
    return $top;
}

function finPartida()
{
    $array=[];
    $array[] = $_SESSION["puntuacion"]['total'];
    $array[] = $_SESSION["usuario"];
    $jugadores=leerTop();
    $jugadores[]=$array;

    $jugadores=ordenarTop($jugadores);
    
    if(count($jugadores)>5)
    array_pop($jugadores);
    
    $fp = fopen('csv/topJugadores.csv', 'w');
    foreach ($jugadores as $elemento) {
        fputcsv($fp, $elemento);
    }
    fclose($fp);
}
