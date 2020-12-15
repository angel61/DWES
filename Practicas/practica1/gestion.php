<?php
/*
 * En esta parte del codigo si se envio un formulario con los datos de un nuevo alumno
 * se guardaran en un array dentro del array de gestion en la sesion
 * si no existe un alumno con el mismo nombre
 */
if (isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["telefono"])
    && isset($_POST["correo"]) && isset($_POST["curso"])) {
    $nombreAux = htmlspecialchars($_POST["nombre"]);
    $apellidosAux = htmlspecialchars($_POST["apellidos"]);
    $telefonoAux = htmlspecialchars($_POST["telefono"]);
    $correoAux = htmlspecialchars($_POST["correo"]);
    $cursoAux = htmlspecialchars($_POST["curso"]);

    if(!isset($_SESSION['gestion'][$nombreAux]))
    $_SESSION['gestion'][$nombreAux] = array($nombreAux, $apellidosAux, $telefonoAux, $correoAux, $cursoAux);
}