<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $operacion=$_POST["operacion"]; echo $operacion;?></title>
</head>
<body>
    <?php
    $numero=intval($_POST["numeros"]);
    $minimo=9999;
    $maximo=-999;
    $suma=0;
    for($i=1;$i<=$numero;$i++){
        $valor=intval($_POST[("numero" . $i)]);
        if($valor<$minimo){
            $minimo=$valor;
        }
        if($maximo<$valor){
            $maximo=$valor;
        }
        $suma+=$valor;
    }
    $media=$suma/$numero;
        switch($operacion){
            case "minimo": echo $minimo;break;
            case "maximo": echo $maximo; break;
            case "media": echo $media; break;
            case "suma": echo $suma; break;
        }
    ?> 
</body>
</html>