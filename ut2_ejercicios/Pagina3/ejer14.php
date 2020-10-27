
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
$IVA=$totalSinIVA*0.21;
$total=$IVA+$totalSinIVA;
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