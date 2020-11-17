<?php
function inicializarSesion()
{
    unset($_SESSION['usuario']);
    $_SESSION["preguntas"]= array();
    $_SESSION["cont"]=0;
    $_SESSION["historico"]=array();
    $_SESSION["puntuacion"]= array();
    $_SESSION["puntuacion"]['ciencia']=0;
    $_SESSION["puntuacion"]['deporte']=0;
    $_SESSION["puntuacion"]['arte']=0;
    $_SESSION["puntuacion"]['historia']=0;
    $_SESSION["puntuacion"]['total']=0;
    $_SESSION["multiplicador"]=1;
}
