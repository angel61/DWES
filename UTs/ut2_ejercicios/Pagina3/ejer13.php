
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$direccion=$_POST["direccion"];
$telefono=$_POST["telefono"];?>
<table border=1> 
    <tr>
        <th>Nombre</th>

        <td><?php echo $nombre?></td>
    </tr> 
    <tr>
        <th>Apellidos</th>

        <td><?php echo $apellidos?></td>
    </tr> 
    <tr>
        <th>Dirección</th>

        <td><?php echo $direccion?></td>
    </tr> 
    <tr>
        <th>Teléfono</th>

        <td><?php echo $telefono?></td>
    </tr> 
</table>
</body>
</html>