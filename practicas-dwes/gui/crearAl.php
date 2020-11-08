<?php
    if(isset($_POST['txtNombre'])){
        $nombre=$_POST['txtNombre'];
        $apellidos=$_POST['txtApellidos']??'';
        $dni=$_POST['txtDNI']??'';
        $nacimiento=$_POST['dtNacimiento']??'';
        $tipoVia=$_POST['slcVia']??'';
        $nomVia=$_POST['txtNomVia']??'';
        $numVia=$_POST['txtNumVia']??'';
        $telefono=$_POST['txtTelefono']??'';
        $localidad=$_POST['txtLocalidad']??'';

        if(annadirAlumno($nombre,$apellidos,$dni,$nacimiento,$tipoVia,$nomVia,$numVia,$telefono,$localidad)){
            echo "<h1>Se añadio el alumno</h1>";
        }
    }
?>

<form method="post" action="crearAl.php">
    <div>
        <div class="frm-row">
            <label for="txtNombre">Nombre: </label>
            <input type="text" name="txtNombre" id="txtNombre" required>
        </div>
        <div class="frm-row">
            <label for="txtApellidos">Apellidos:</label>
            <input type="text" name="txtApellidos" id="txtApellidos" required>
        </div>
        <div class="frm-row">
            <label for="txtDNI">DNI:</label>
            <input type="text" name="txtDNI" id="txtDNI" required>
        </div>
        <div class="frm-row">
            <label for="dtNacimiento">Fecha de nacimiento:</label>
            <input type="date" name="dtNacimiento" id="dtNacimiento" required>
        </div>
        <div class="frm-row">
            <label for="slcVia">Tipo de via:</label>
            <select name="slcVia" id="slcVia">
                <?php
                foreach (getTipoVia() as $key => $value) {
                    echo "<option value=\"$key\">$value</option>";
                }
                ?>
            </select>
        </div>
        <div class="frm-row">
            <label for="txtNomVia">Nombre de via:</label required>
            <input type="text" name="txtNomVia" id="txtNomVia">
        </div>
        <div class="frm-row">
            <label for="txtNumVia">Numero de via:</label>
            <input type="text" name="txtNumVia" id="txtNumVia" required>
        </div>
        <div class="frm-row">
            <label for="txtTelefono">Telefono:</label>
            <input type="text" name="txtTelefono" id="txtTelefono" required>
        </div>
        <div class="frm-row">
            <label for="txtLocalidad">Localidad:</label>
            <input type="text" name="txtLocalidad" id="txtLocalidad" required>
        </div>
        <br>
        <input type="submit" value="Añadir">
    </div>
</form>