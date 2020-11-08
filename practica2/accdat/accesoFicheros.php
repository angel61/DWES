<?php
function editarPregunta($array)
{
    $fp = fopen('preguntas.csv', 'a');
    fputcsv($fp, $array);
    fclose($fp);
}
