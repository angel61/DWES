<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $operacion=$_POST["operacion"]; echo $operacion;?></title>
</head>
<body>
    <?php
    $numero=intval($_POST["numero"]);
        switch($operacion){
            case "Opuesto": echo (0-$numero); break;
            case "Inverso": echo (1/$numero); break;
            case "Cuadrado": echo ($numero*$numero); break;
            case "Raiz cuadrada": echo sqrt($numero); break;
            case "Sumatorio": 
                $aux=0;
                for($i=1;$i<=$numero;$i++){
                    $aux+=$i;
                }
                echo $aux;
            break;
            case "Factorial": 
                $aux=1;
                for($i=1;$i<=$numero;$i++){
                    $aux*=$i;
                }
                echo $aux;
            break;
        }
    ?> 
</body>
</html>