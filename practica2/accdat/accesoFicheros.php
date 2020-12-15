<?php

#Funcion para guardar una pregunta en el csv de preguntas
function editarPregunta($array)
{
    $fp = fopen('csv/preguntas.csv', 'a');
    fputcsv($fp, $array);
    fclose($fp);
}

#Funcion para cargar la siguiente pregunta del array de preguntas
function cargarPregunta()
{
    $cont= $_SESSION["cont"];
    #Si no esta cargado el array de preguntas se carga
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

#Se comprueba la respuesta y se devuelve un boolean con el resultado
function comrobarPregunta($respuesta, $pregunta)
{
    $comprobacion=$respuesta==$pregunta[7];
    return $comprobacion;
}

#Se lee el top de jugadores y se devuelve el top  en forma de array
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

#Se ordena el top con el nuevo usuario
function ordenarTop($top)
{
    $puntuacion  = array_column($top, 0);
    $nombre = array_column($top, 1);

    array_multisort($puntuacion, SORT_DESC, $nombre, SORT_ASC, $top);
    return $top;
}

#Se añade al array del top de jugadores el ultimo jugador y su puntuacion
#Si hay mas de 5 jugadores se elimina el ultimo
#Y por ultimo se sobre escribe el archivo del top
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
