<h1>Importar CSV</h1>
<form name="frmImportar CSV" action="importCSV.php" method="post" class="tblDatos" enctype="multipart/form-data">
    <label class="etiqueta">Elige la tabla:</label>
    <select name="lstTabla">
        <option value="alumnos">Alumnos</option>
        <option value="usuarios">Usuarios</option>
    </select>
    <label class="etiqueta">Elige el fichero:</label>
    <input type="file" name="flFichero">
    <label class="etiqueta"></label><br><br>
    <input class="boton" type="submit" value="Importar" id="cmdEnviar">
</form>