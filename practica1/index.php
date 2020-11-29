<!DOCTYPE html>
<?php session_start(); ?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gui/estilo.css">
    <title>Practica Angel Lopez</title>
</head>

<body onload="onLoad_body();">
<!-- En este php solo contiene el html con las llamadas a cada archivo php -->
<!-- El html contiene dos formulario para dividir la creacion de alumnos y la consulta de alumnos -->
<div class="contenido">
    <div class="gestion">
        <form class="inputs" action="index.php" method="POST">
            <div>
                Nombre<input type="text" name="nombre" required>
            </div>
            <div>
                Apellidos<input type="text" name="apellidos" required>
            </div>
            <div>
                Telefono<input type="number" name="telefono" required>
            </div>
            <div>
                Correo<input type="text" name="correo" required>
            </div>
            <div>
                Curso<select name="curso">
                    <option>Curso 1</option>
                    <option>Curso 2</option>
                </select>
            </div>
            <br>
            <input type="submit" value="Guardar">
        </form>
        <?php require_once("gestion.php"); ?>
    </div>
    <div class="consulta">
        <form id="frmSeleccion" action="index.php" method="POST">
            <select size="6" id="seleccion" name="seleccion">
                <?php require_once("select_consulta.php"); ?>
            </select>
        </form>
        <br>
        <div class="resultado">
            <?php require_once("resultado.php"); ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/eventos.js"></script>
</body>

</html>