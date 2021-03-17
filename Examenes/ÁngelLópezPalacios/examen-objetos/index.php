<?php
session_start();
require_once("accdat/BBDD.php");
require_once("accdat/ficheros.php");
require_once("./gui/cabecera.php");
?>
<br>
<div>
    <?php
    $tipo = $_SESSION['tipo'] ?? 'i';
    if (isset($_REQUEST['opcionPie']))
        $_SESSION['opcion'] = $_REQUEST['opcionPie'];
    switch ($_SESSION['opcion']) {
        case "inicio":
            require_once("./gui/inicio.php");
            break;
        case "cerrar":
            require_once("./gui/cerrar.php");
            break;
        case "registro":
            require_once("./gui/registro.php");
            break;
        case "editar":
            if ($tipo == "a") {
                require_once("./gui/editar.php");
            } else {
                require_once("./gui/accesoDenegado.php");
            }
            break;
        case "listado":
            if ($tipo == "a" || $tipo == "u") {
                require_once("./gui/listado.php");
            } else {
                require_once("./gui/accesoDenegado.php");
            }
            break;
        case "actividad":
            if ($tipo == "a") {
                require_once("./gui/actividad.php");
            } else {
                require_once("./gui/accesoDenegado.php");
            }
            break;
    }
    ?>
</div>
<br>
<?php
require_once("./gui/pie.php");
?>