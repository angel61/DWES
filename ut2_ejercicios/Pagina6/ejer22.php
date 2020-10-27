<?php 
$nombre=$_POST['nombre'];
$numero=$_POST['numero'];
$min=1;
$max=6;
$dado1=rand($min, $max);
$dado2=rand($min, $max);
$resultado=$dado1+$dado2;
echo "Suerte, $nombre<br/>Jugada:$numero<br/><img width=\"5%\" height=\"10%\" src=\"img/dado$dado1.png\"><img width=\"5%\" height=\"10%\" src=\"img/dado$dado2.png\"><br/>";
if($resultado==$numero) {
    echo "Ganaste!!!!";
} else {
    echo "Perdiste :(";
}
?>