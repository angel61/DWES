<?php
include_once ("clases/Persona.php");
include_once ("clases/BBDD.php");
include_once ("clases/App.php");
$app = new App();


$app->run($_REQUEST);