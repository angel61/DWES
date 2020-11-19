<?php
    session_start();
    require_once("accdat/accesoFicheros.php");
    require_once("funciones.php");


    $opcionElegida=$_POST["btn"]??'';
    $auxCont=$_POST["hdnPregunta"]??"0";
    $contador=intval($auxCont);
    $categoria=$_SESSION['pregunta'][6]??'';

        if ($opcionElegida!='') {
            if (comrobarPregunta($opcionElegida, $_SESSION['preguntas'][$contador])) {
                $comprobacion=$_SESSION["registro"][$contador]??true;
                if ($comprobacion) {
                    $_SESSION['puntuacion'][$categoria]++;
                    $_SESSION['puntuacion']['total']+=10*$_SESSION["multiplicador"];
                
                    $_SESSION["multiplicador"]*=2;
                    $_SESSION["registro"][$contador]=false;
                }
            } else {
                header("Location: index.php");
                exit;
            }

            $_SESSION["cont"]=$contador+1;

            esFinDePartida();
            $_SESSION['pregunta']=cargarPregunta();
            while ($_SESSION["puntuacion"][($_SESSION['pregunta'][6])]>=5&&($_SESSION["cont"]<(count($_SESSION["preguntas"])-1))) {
                $_SESSION["cont"]++;
                $_SESSION['pregunta']=cargarPregunta();
            }
            esFinDePartida();
        }
        
        if ($contador==0) {
            $_SESSION['pregunta']=cargarPregunta();
        }