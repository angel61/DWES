<?php
session_start();
include_once ("clases/Objetos.php");
include_once ("clases/BBDD.php");
include_once ("clases/App.php");
$app = new App();


$app->run($_REQUEST);