<?php
/*
Ejercicio 2 - UT3

2. Utilizando los datos de la BD de la NBA, crea una aplicación web que permita
seleccionar un equipo de la NBA y muestre todos los jugadores de dicho equipo. 
*/
session_start();
include_once ("clases/Persona.php");
include_once ("clases/BBDD.php");
include_once ("clases/App.php");
include_once ("clases/phtml.php");
$app = new App();


$app->run($_REQUEST);