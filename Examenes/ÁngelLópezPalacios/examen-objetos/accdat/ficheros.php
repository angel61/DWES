<?php 
function registroActividad($nombre, $resultado, $tipoOpe)
{
    $date = new DateTime();
    $regis = [$date->format('Ymd_Hi'), $nombre, $resultado, $tipoOpe];
    $fp = fopen('csv/registro.csv', 'a');
    fputcsv($fp, $regis);
    fclose($fp);
}

function getActividad()
{

    $actividad = [];
    $fp = fopen('csv/registro.csv', 'r');
    while (($regist = fgetcsv($fp, 1000, ",")) !== false) {
        $actividad[] = $regist;
    }
    fclose($fp);

    return $actividad;
}