<?php
$iniciovalido = true;
$usu = $_REQUEST['txtUser'] ?? "";
$pass = $_REQUEST['txtPass'] ?? "";
if ($usu !== '')
    $iniciovalido = comprobarUsuario($usu, $pass);
if (!$iniciovalido) {
    echo "Credenciales no correctas.";
}
?>
<form action="index.php" method="POST">
    <table>
        <tr>
            <td>Usuario:</td>
            <td><input type="text" name="txtUser" id="txtUser"></td>
        </tr>
        <tr>
            <td>Clave:</td>
            <td><input type="password" name="txtPass" id="txtPass"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="inicio" value="Inicio">
            </td>
        </tr>
    </table>
</form>