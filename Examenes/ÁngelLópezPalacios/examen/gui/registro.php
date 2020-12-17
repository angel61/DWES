<?php
$usu = $_REQUEST['txtUser'] ?? "";
$pass = $_REQUEST['txtPass'] ?? "";
$corr = $_REQUEST['txtCorreo'] ?? "";
if ($usu !== '' && $pass !== '' && $corr !== '') {
    annadirUsuario($usu, $pass, $corr, "u");
    $iniciovalido = comprobarUsuario($usu, $pass);
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
            <td>Correo:</td>
            <td><input type="text" name="txtCorreo" id="txtCorreo"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="registro" value="Registro">
            </td>
        </tr>
    </table>
</form>