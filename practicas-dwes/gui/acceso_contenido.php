<?php
function acceso($tipo){
    $us = $_REQUEST['txtUser'] ?? "";
    $pw = $_REQUEST['txtPass'] ?? "";
    $usuAnt = $_SESSION['usuario'] ?? "";
    $usuTipo = $_SESSION['tipo'] ?? "";
    if($tipo==="e"){
        if (($usuAnt || validarUsuario($us, $pw))&&$usuTipo=="e")
            return true;
        else
            return false;
    }else{
        if (($usuAnt || validarUsuario($us, $pw)))
            return true;
        else
            return false;
    }
}