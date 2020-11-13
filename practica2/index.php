<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Angel</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
<?php
session_start();
require_once("accdat/accesoFicheros.php");

unset($_SESSION['usuario']);
$_SESSION["preguntas"]= array();
$_SESSION["cont"]=0;
$_SESSION["historico"]=array();
$_SESSION["puntuacion"]= array();
$_SESSION["puntuacion"]['ciencia']=0;
$_SESSION["puntuacion"]['deporte']=0;
$_SESSION["puntuacion"]['arte']=0;
$_SESSION["puntuacion"]['historia']=0;
$_SESSION["puntuacion"]['total']=0;
$_SESSION["multiplicador"]=1;

$topUsuarios=leerTop();
?>
    <div class="contenido">
        <div class="imagen-pregunta">
            <h1>TOP 5</h1>
            <div>
                <?php
                foreach($topUsuarios as $usuario)
                echo "<div class=\"puntuacion\">".$usuario[0]."</div><div class=\"usuario\">".$usuario[1]."</div>";
                ?>
            </div>
        </div>
        <div class="control">
            <div class="titulo">
                <h1>Selecciona una opción</h1>
            </div>
            <div class="opciones-reducidas">
                <div class="opcion">
                    <a href="editar.php">Editar preguntas</a>
                </div>
                <div class="opcion">
                    <a href="comprobar_pregunta.php">Jugar una partida</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>