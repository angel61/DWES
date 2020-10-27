<?php 
$valorFinal=0;
$salsa=$_POST['salsa'];
$base=$_POST['base'];
$tamanno=$_POST['tamanno'];

$valorFinal=$salsa+$base+$tamanno;

if(isset($_POST['pollo'])){
    $valorFinal+=$_POST['pollo'];
}

if(isset($_POST['bacon'])){
    $valorFinal+=$_POST['bacon'];
}

if(isset($_POST['jamon'])){
    $valorFinal+=$_POST['jamon'];
}

if(isset($_POST['cebolla'])){
    $valorFinal+=$_POST['cebolla'];
}

if(isset($_POST['aceitunas'])){
    $valorFinal+=$_POST['aceitunas'];
}

if(isset($_POST['pimientos'])){
    $valorFinal+=$_POST['pimientos'];
}
echo $valorFinal;
?>