
<form name="frmImportarCSV" action="a.php" method="post" class="tblDatos" enctype="multipart/form-data">
    <label class="etiqueta">Elige el fichero:</label>
    <input type="file" name="flFichero">
    <input class="boton" type="submit" value="Importar" id="cmdEnviar">
</form>
<?php
    var_dump($_POST);
    var_dump($_FILES);
if(isset($_FILES['flFichero']))
    var_dump($_FILES);