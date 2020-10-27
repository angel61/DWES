<?php
function validarUsuario(string $us,string $pw):bool {
    $validado = false;
    $tipo = "e";

    if ($us === "a" && $pw === "a") $validado = true;

    if($validado){$_SESSION['usuario']=$us;$_SESSION['tipo']=$tipo;}
    else{unset($_SESSION['usuario']);unset($_SESSION['tipo']);}
    return $validado;
}
