<div class="centro">
    <form name="frm2" action="index.php" method="post">
        <table>
            <tr><td>Nombre</td><td><input type="text" name="nombre"></td></tr>
            <tr><td>1er Apellido</td><td><input type="text" name="ap1"></td></tr>
            <tr><td>2º Apellido</td><td><input type="text" name="ap2"></td></tr>
            <tr><td>Tipo Vía</td><td><?php $this->printTipoVia(); ?></tr>
            <tr><td>Direccion</td><td><input type="text" name="direccion"></td></tr>
            <tr><td colspan="2"><input type="submit" name="datosMod" value="enviar"></td></tr>
        </table>
    </form>
</div>