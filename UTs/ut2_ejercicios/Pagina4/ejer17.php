
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php 
$texto=$_POST["texto"];
$estilo=$_POST["estilo"];
$tamanno=$_POST["tamanno"];
$color=$_POST["color"];
?>
<p style="border: <?php echo $tamanno . "px ". $estilo . " " . $color?>;">
        <?php echo $texto?>

</p>
</body>
</html>