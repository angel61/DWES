<?php
    session_start();
    require_once("accdat/accesoFicheros.php");
    
    function finPreguntas()
    {
    }


    $opcionElegida=$_POST["btn"]??'';
    $contador=$_SESSION["cont"];
    $categoria=$_SESSION['pregunta'][6]??'';

        if ($opcionElegida!='') {
            if (comrobarPregunta($opcionElegida, $_SESSION['pregunta'])) {
                $comprobacion=$_SESSION["registro"][intval($_POST["hdnPregunta"])]??true;
                if ($comprobacion){
                $_SESSION['puntuacion'][$categoria]++;
                $_SESSION['puntuacion']['total']+=10*$_SESSION["multiplicador"];
                
                $_SESSION["multiplicador"]*=2;
                $_SESSION["registro"][intval($_POST["hdnPregunta"])]=false;
            }
            } else {
                header("Location: index.php");
                exit;
            }

            $_SESSION["cont"]=intval($_POST["hdnPregunta"])+1;

            $_SESSION['pregunta']=cargarPregunta();
            while ($_SESSION["puntuacion"][($_SESSION['pregunta'][6])]>=5&&($_SESSION["cont"]<(count($_SESSION["preguntas"])-1))) {
                $_SESSION["cont"]++;
                $_SESSION['pregunta']=cargarPregunta();
            }
            
            if ($_SESSION["cont"]>(count(($_SESSION["preguntas"]))-1)) {
                $_SESSION['puntuacion']['total']+=1000;
                header("Location: index.php");
                exit;
            }

            header("Location: preguntas.php");
            exit;
        }
        
        if ($contador==0) {
            $_SESSION['pregunta']=cargarPregunta();
            header("Location: preguntas.php");
            exit;
        }
