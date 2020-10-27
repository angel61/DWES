
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$precioA=5.99;
$precioB=12.49;
$precioC=19.99;

$cantidadA=$_POST["articuloa"];
$cantidadB=$_POST["articulob"];
$cantidadC=$_POST["articuloc"];

$subtotalA=$precioA*$cantidadA;
$subtotalB=$precioA*$cantidadB;
$subtotalC=$precioA*$cantidadC;

$totalSinIVA=$subtotalA+$subtotalB+$subtotalC;

$cantidadTotal=$cantidadC+$cantidadB+$cantidadA;
$descuento;
$porcentajeDescuento;
if($cantidadTotal>20){
    $descuento=$totalSinIVA*0.25;
    $porcentajeDescuento="25%";
}elseif ($cantidadTotal>=11&&$cantidadTotal<=20) {
    $descuento=$totalSinIVA*0.1;
    $porcentajeDescuento="10%";
} elseif($cantidadTotal>=5&&$cantidadTotal<=10) {
    $descuento=$totalSinIVA*0.05;
    $porcentajeDescuento="5%";
} else{

}

$IVA=($totalSinIVA-$descuento)*0.21;
$total=$IVA+$totalSinIVA-$descuento;
?>
<table border=1> 
    <tr>
        <th>Articulo</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Subtotal</th>
    </tr>
    <tr>
        <td>Articulo A</td>
        <td> <?php echo $precioA?></td>
        <td><?php echo $cantidadA?></td>
        <td><?php echo number_format($subtotalA,2)?></td>
    </tr>
    <tr>
        <td>Articulo B</td>
        <td><?php echo $precioB?></td>
        <td><?php echo $cantidadB?></td>
        <td><?php echo number_format($subtotalB,2)?></td>
    </tr>
    <tr>
        <td>Articulo C</td>
        <td><?php echo $precioC?></td>
        <td><?php echo $cantidadC?></td>
        <td><?php echo number_format($subtotalC,2)?></td>
    </tr>
</table>
<br>
<table border=1> 
    <tr>
        <th>Descuento <?php echo $porcentajeDescuento?></th>
        <td><?php echo number_format($descuento,2)?></td>
    </tr>
    <tr>
        <th>IVA (21%)</th>
        <td><?php echo number_format($IVA,2)?></td>
    </tr>
    <tr>
        <th>TOTAL</th>
        <td><?php echo number_format($total,2)?></td>
    </tr>
</table>
</body>
</html>