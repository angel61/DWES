<?php
function pasoActual()
{
    if (isset($_REQUEST['slcConfereciaJ1'])&&isset($_REQUEST['slcConfereciaJ2'])) {
        $_SESSION['conferencia'][0]=$_REQUEST['slcConfereciaJ1'];
        $_SESSION['conferencia'][1]=$_REQUEST['slcConfereciaJ2'];
        return "equipos";
    } elseif (isset($_REQUEST['slcEquipoJ1'])&&isset($_REQUEST['slcEquipoJ2'])) {
        $_SESSION['equipo'][0]=$_REQUEST['slcEquipoJ1'];
        $_SESSION['equipo'][1]=$_REQUEST['slcEquipoJ2'];
        return "jugadores";
    } elseif (isset($_REQUEST['slcJ1'])&&isset($_REQUEST['slcJ2'])) {
        $_SESSION['jugador'][0]=$_REQUEST['slcJ1'];
        $_SESSION['jugador'][1]=$_REQUEST['slcJ2'];
        return "comparacion";
    } else {
        return "conferencias";
    }
}

function borrarSesion()
{
    session_destroy();
}