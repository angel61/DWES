<?php
$usu = $_REQUEST['txtUser'] ?? "";
$tip = $_REQUEST['txtTipo'] ?? "";
if ($tipo == 'a') {
    editarUsuario($usu, $tip);
}
?>
<form action="index.php" method="POST">
    <table>
        <tr>
            <td>Usuario:</td>
            <td>
                <select name="txtUser" id="txtUser">
                    <?php
                    foreach (getUsuarios() as $key => $value) {
                        echo "<option value=\"$value\">$value</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tipo:</td>
            <td>
                <select name="txtTipo">
                    <option value="i">Invitado</option>
                    <option value="u">Usuario</option>
                    <option value="a">Admin</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="inicio" value="Editar">
            </td>
        </tr>
    </table>
</form>