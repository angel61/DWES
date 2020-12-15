<?php
session_start();
require_once("accdat/accesoFicheros.php");
require_once("funciones.php");


$opcionElegida = $_POST["btn"] ?? '';
$auxCont = $_POST["hdnPregunta"] ?? "0";
$contador = intval($auxCont);
$categoria = $_SESSION['pregunta'][6] ?? '';

#Si se eligio alguna opcion se continuara
if ($opcionElegida != '') {
    #Si la pregunta es correcta se comprobara si la pregunta ya fue contestada
    if (comrobarPregunta($opcionElegida, $_SESSION['preguntas'][$contador])) {
        $comprobacion = $_SESSION["registro"][$contador] ?? true;
        #Si la pregunta no fue preguntada anteriormente resgistrara como resuelta y se sumaran los puntos
        if ($comprobacion) {
            $_SESSION['puntuacion'][$categoria]++;
            $_SESSION['puntuacion']['total'] += 10 * $_SESSION["multiplicador"];

            $_SESSION["multiplicador"] *= 2;
            $_SESSION["registro"][$contador] = false;
        }

    #Si la pregunta no es correcta se volvera al menu de inicio
    } else {
        header("Location: index.php");
        exit;
    }

    #Se aumenta el valor al indice de preguntas
    $_SESSION["cont"] = $contador + 1;

    esFinDePartida();

    #Se carga una pregunta nueva
    $_SESSION['pregunta'] = cargarPregunta();

    /*
     * Si la categoria de la pregunta nueva ya fue completada
     * o aun no se terminaron las preguntas se seguiran cargandos preguntas.
     */
    while ($_SESSION["puntuacion"][($_SESSION['pregunta'][6])] >= 5 && ($_SESSION["cont"] < (count($_SESSION["preguntas"]) - 1))) {
        $_SESSION["cont"]++;
        $_SESSION['pregunta'] = cargarPregunta();
    }
    esFinDePartida();
}


#Si es la primera pregunta como no es posible haber respondido se carga una pregunta
if ($contador == 0) {
    $_SESSION['pregunta'] = cargarPregunta();
}