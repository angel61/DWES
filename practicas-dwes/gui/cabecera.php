
    <div class="titulo">
        <h1>Proyecto 2º DAW - DWES</h1>
        <h2>Ángel López Palacios</h2>
    </div>
<div class="login">
        <?php
        $us = $_REQUEST['txtUser'] ?? "";
        $pw = $_REQUEST['txtPass'] ?? "";

        $cerrarSess = $_REQUEST['hdnSess'] ?? false;
        if ($cerrarSess) {
            unset($_SESSION['usuario']);
            unset($_SESSION['tipo']);
        }
        $usuAnt = $_SESSION['usuario'] ?? "";

        if ($usuAnt || validarUsuario($us, $pw)) {
        ?>
            <form action="index.php" method="POST" name="frmLogin">
                <fieldset>
                    <input type="submit" name="hdnSess" id="hdnSess" value="Cerrar sesion">
                    <?php echo $_SESSION['usuario']?>
                </fieldset>
            </form>
        <?php
        } else {
        ?>
            <form action="index.php" method="POST" name="frmLogin">
                <fieldset>
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
                            <td class="colInicio" colspan="2">
                                <input class="inicio" type="button" name="cmdValidar" id="cmdValidar" value="Inicio">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        <?php
        }
        ?>
    </div>
    <div class="navbar">
        <nav>
            <a href="importCSV.php">Importar CSV</a>
            <a href="exportCSV.php">Exportar CSV</a> |
            <a href="crearAl.php">Crear alumno</a>
            <a href="modAl.php">Modificar alumno</a>
            <a href="borrarAl.php">Borrar alumno</a>
            <a href="consAl.php">Consultar alumno</a>
        </nav>
    </div>