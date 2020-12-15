<?php
$nombre = "Pepe";
$apellidos = "Martin Lopez";
$direccion = "C/ Florida";
$codigoPostal = 16223;
$localidad = "Guadalajara";
$provincia = "Guadalajara";
echo "<table border=1>
<tr>
    <th>Variable</th> <th>Valor</th> <th>Tipo</th>
</tr>
<tr>
    <td>nombre</td> <td>$nombre</td> <td>" . gettype($nombre) . "</td>
</tr>
<tr>
    <td>apellidos</td> <td>$apellidos</td> <td>" . gettype($apellidos) . "</td>
</tr>
<tr>
    <td>direccion</td> <td>$direccion</td> <td>" . gettype($direccion) . "</td>
</tr>
<tr>
    <td>codigoPostal</td> <td>$codigoPostal</td> <td>" . gettype($codigoPostal) . "</td>
</tr>
<tr>
    <td>localidad</td> <td>$localidad</td> <td>" . gettype($localidad) . "</td>
</tr>
<tr>
    <td>provincia</td> <td>$provincia</td> <td>" . gettype($provincia) . "</td>
</tr>
</table>";
