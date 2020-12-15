<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $operacion=$_POST["operacion"]; echo $operacion;?></title>
</head>
<body>
    <form action="ejer21res.php" method="POST">
        <input type="hidden" name="operacion" value="<?php echo $operacion;?>">
    <?php

    $numero=intval($_POST["numero"]);
    for($i=1;$i<=$numero;$i++){
       echo "Numero $i:<input type=\"number\" name=\"numero$i\"><br>";
    }
    ?> 
    <input type="hidden" name="numeros" value="<?php echo $numero;?>">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>