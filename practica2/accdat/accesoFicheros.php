<?php

function editarPregunta($array)
{
    $fp = fopen('preguntas.csv', 'a');
    fputcsv($fp, $array);
    fclose($fp);
}
function cargarPregunta()
{
    $cont= $_SESSION["cont"];
    if(count($_SESSION["preguntas"])<=0){
        $fp = fopen('preguntas.csv', 'r');
        while (($preg = fgetcsv($fp, 1000, ",")) !== false) {
            $_SESSION["preguntas"][]= $preg;
        }
        fclose($fp);
    }
     
    return $_SESSION["preguntas"][$cont];
}
function comrobarPregunta($respuesta,$pregunta)
{
    if($respuesta==$pregunta[7]){
        return true;
    }else{
        return false;
    }
}
function resetPreguntas(){
    $_SESSION["cont"]=0;
}
