
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Tipo</th>
    </tr>
    <?php 
        foreach (getListado() as $key => $value) {
            echo "<tr><td>".$value[0]."</td><td>".$value[1]."</td><td>".$tipoUsu[$value[2]]."</td></tr>";
        }
    ?>
</table>