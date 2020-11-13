<?php
    session_start();
    require_once("accdat/accesoFicheros.php");
    $opcionElegida=$_POST["btn"]??'';
    $contador=$_SESSION["cont"];
    $categoria=$_SESSION['pregunta'][6]??'';

        if ($opcionElegida!='') {
            if (comrobarPregunta($opcionElegida, $_SESSION['pregunta'])) {
                $_SESSION['puntuacion'][$categoria]++;
                $_SESSION['puntuacion']['total']+=10*$_SESSION["multiplicador"];
                $_SESSION["multiplicador"]*=2;
            }else{
                finPartida();
                header("Location: index.php");
                exit;
            }

            $_SESSION["cont"]=intval($_POST["hdnPregunta"])+1;
            
            if ($contador>=(count(($_SESSION["preguntas"]))-1)) {
                $_SESSION['puntuacion']['total']+=1000;
                finPartida();
                header("Location: index.php");
                exit;
            }
            $_SESSION['pregunta']=cargarPregunta();
            header("Location: preguntas.php");
            exit;
        }
        
        if ($contador==0) {
            $_SESSION['pregunta']=cargarPregunta();
            header("Location: preguntas.php");
            exit;
        }