<table border="1">
    <tr>
        <th>Hora</th>
        <th>Usuario</th>
        <th>Operacion</th>
        <th>Tipo de operacion</th>
    </tr>
    <?php 
        foreach (getActividad() as $key => $value) {
            $valor='Exitosa';
            if(!$value[2]){
                $valor='Fallida';
            }
            echo "<tr><td>".$value[0]."</td><td>".$value[1]."</td><td>".$valor."</td><td>".$value[3]."</td></tr>";
        }
    ?>
</table>