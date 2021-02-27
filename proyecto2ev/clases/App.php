<?php


class App
{
    private function printHead()
    {
        if (isset($_SESSION['usuarioDatos']))
            include_once("gui/head_logged.php");
        else
            include_once("gui/head.html");
    }
    private function printBody()
    {
        $paso = $_REQUEST["paso"] ?? "";
        $vistaProducto = isset($_REQUEST["hdnProducto"]);
        $pasoInicio = $paso == "iniciar"&&!isset($_SESSION['usuarioDatos']);
        $pasoRegistrar = $paso == "registrar"&&!isset($_SESSION['usuarioDatos']);
        $pasoInfo = $paso == "info"&&isset($_SESSION['usuarioDatos']);
        switch (true) {
            case $vistaProducto:
                include_once("gui/vistaProducto.php");
                break;
            case $pasoInicio:
                include_once("gui/login.php");
                break;
            case $pasoRegistrar:
                include_once("gui/registrar.php");
                break;
            case $pasoInfo:
                include_once("gui/vistaUsuario.php");
                break;
            default:
                include_once("gui/listado_productos.php");
                break;
        }
    }
    private function printFoot()
    {
        include_once("gui/foot.html");
    }

    public function printProductos()
    {
        $bbdd = new BBDD();
        $productos = $bbdd->getProductos();
        unset($bbdd);


        foreach ($productos as $producto)
            echo "<div  class=\"col-md-4 col-lg-3 card d-flex flex-column justify-content-between\" name='producto' onclick='vistaProducto({$producto->id});'>
            <img class=\"card-img-top\" src=\"{$producto->rutaImg}\" alt=\"\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">{$producto->nombre}</h5>
                <p class=\"card-text\">{$producto->descripcion}</p>
            </div>
        </div>";
    }

    private function printProducto($id)
    {
        $bbdd = new BBDD();
        $producto = $bbdd->getProducto($id);
        unset($bbdd);

        if ($producto != null)
            echo "<div  class=\"col-7\">
        <img class=\"img-fluid\" src=\"{$producto->rutaImg}\" alt=\"\">
    </div>
    <div  class=\"col-5\">
    <h2>{$producto->nombre}</h2>
    <p>{$producto->descripcion}</p>
</div>";
    }

    private function printInfoPersonal()
    {
        $bbdd = new BBDD();
        $usuario = $bbdd->getUsuario($_SESSION['usuarioDatos']['correo']);
        unset($bbdd);

        if ($usuario != null)
        echo "<table class='table table-hover'>
        <tr><th class='text-secondary'>NOMBRE</th><td>{$usuario->nombre}</td></tr>
        <tr><th class='text-secondary'>APELLIDOS</th><td>{$usuario->apellidos}</td></tr>
        <tr><th class='text-secondary'>CORREO</th><td>{$usuario->correo}</td></tr>
        <tr><th class='text-secondary'>CONTRASEÑA</th><td>*********</td></tr>
        </table>";
    }
    private function printErrorLogin()
    {
        if (isset($_SESSION['errorLog'])) {
            echo "<div class='text-danger pb-3'>{$_SESSION['errorLog']}</div>";
            unset($_SESSION['errorLog']);
        }
    }
    public function printErrorRegistrar()
    {
        if (isset($_SESSION['errorReg'])) {
            echo "<div class='text-danger pb-3'>{$_SESSION['errorReg']}</div>";
            unset($_SESSION['errorReg']);
        }
    }
    public function run($p = null)
    {
        //Cerrar sesion
        if (isset($_REQUEST['cerrarSesion'])&&isset($_SESSION['usuarioDatos'])) {
            unset($_SESSION['usuarioDatos']);
            header("Location: index.php");
        }

        //Login
        if (isset($_REQUEST['loginEmail']) && isset($_REQUEST['loginPass'])) {
            $bbdd = new BBDD();
            $usuario = $bbdd->login($_REQUEST['loginEmail'], $_REQUEST['loginPass']);
            unset($bbdd);
            if ($usuario != null)
                $_SESSION['usuarioDatos'] = ["nombre" => $usuario->nombre, "correo" => $usuario->correo, "tipo" => $usuario->tipo];
            else {
                $_SESSION['errorLog'] = 'Correo o contraseña incorrectos.';
                header("Location: index.php?paso=iniciar");
            }
        }

        //Registro
        if (isset($_REQUEST['registrarNombre']) && isset($_REQUEST['registrarApellidos']) && isset($_REQUEST['registrarEmail']) && isset($_REQUEST['registrarPass'])) {
            $bbdd = new BBDD();
            $registro = $bbdd->setUsuario(new Usuario($_REQUEST['registrarNombre'], $_REQUEST['registrarApellidos'], $_REQUEST['registrarEmail'], $_REQUEST['registrarPass']));
            unset($bbdd);
            if ($registro) {
                header("Location: index.php");
            } else {
                $_SESSION['errorReg'] = 'El correo ya esta siendo utilizado.';
                header("Location: index.php?paso=registrar");
            }
        }

        $this->printHead();

        $this->printBody();

        $this->printFoot();
    }
}
