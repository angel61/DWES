<?php


class App
{
    private function printHead()
    {
        include_once("gui/head.php");
    }
    private function printBody()
    {
        $paso = $_REQUEST["paso"] ?? "";
        if ($paso != "anadirDireccion" && $paso != "anadirPago")
            $_SESSION['ultimoPaso'] = $paso;
        $vistaProducto = $paso == "producto";
        $pasoInicio = $paso == "iniciar" && !isset($_SESSION['usuarioDatos']);
        $pasoRegistrar = $paso == "registrar" && !isset($_SESSION['usuarioDatos']);
        $pasoInfo = $paso == "info" && isset($_SESSION['usuarioDatos']);
        $pasoAnadirDireccion = $paso == "anadirDireccion";
        $pasoAnadirPago = $paso == "anadirPago";
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
            case $pasoAnadirDireccion:
                include_once("gui/nuevaDireccion.php");
                break;
            case $pasoAnadirPago:
                include_once("gui/nuevoPago.php");
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
        $busqueda = $_REQUEST["inpBusqueda"] ?? "";
        $pagina = $_REQUEST['pagina'] ?? 1;
        $limite = $_REQUEST['limite'] ?? 12;
        $bbdd = new BBDD();
        $productos = $bbdd->getProductos($busqueda, $pagina, $limite);
        unset($bbdd);

        if ($productos != null) {
            echo "<input type='hidden' value='$busqueda' name='inpBusqueda'>";
            foreach ($productos as $producto) {
                $precio = number_format($producto->precio, 2, ',', '.') . "€";
                echo '<div class="col-md-4 col-lg-3">
                        <div class="card card-product">
                            <div class="img-wrap"> 
                                <img src="img\\' . $producto->rutaImg . '">
                            </div>
                            <div class="info-wrap">
                                <h6 class="title text-dots"><a href="index.php?paso=producto&producto=' . $producto->id . '">' . $producto->nombre . '</a></h6>
                                <div class="action-wrap">
                                    <a href="#" class="btn btn-primary btn-sm float-right"> Comprar </a>
                                    <div class="price-wrap h5">
                                        <span class="price-new">' . $precio . '</span>
                                        <del class="price-old"></del>
                                    </div> 
                                </div>
                            </div>
                        </div> 
                    </div>';
            }
        } else
        echo "<div class='h2 text-secondary w-100 text-center pt-4'>No se encontro ningun producto.</div>";
    }
    public function printPaginacion($limite = 12)
    {
        $busqueda = $_REQUEST["inpBusqueda"] ?? "";
        $bbdd = new BBDD();
        $total = $bbdd->getTotalProductos($busqueda);
        unset($bbdd);

        $pagina = $_REQUEST['pagina'] ?? 1;
        $links = 2;

        $ultimaPagina = ceil($total / $limite);

        $principio = (($pagina - $links) > 0) ? $pagina - $links : 1;
        $fin  = (($pagina + $links) < $ultimaPagina) ? $pagina + $links : $ultimaPagina;

        $paginacion = '<ul class="w-100  justify-content-center py-lg-4 pagination">';

        $clase = ($pagina == 1) ? "disabled" : "";
        $paginacion .= '<li class="page-item ' . $clase . '"><a class="page-link" href="?pagina=' . ($pagina - 1) . '">&laquo;</a></li>';

        if ($principio > 1) {
            $paginacion .= '<li class="page-item"><a class="page-link" href="?pagina=1">1</a></li>';
            $paginacion .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        for ($i = $principio; $i <= $fin; $i++) {
            $clase  = ($pagina == $i) ? "active" : "";
            $paginacion .= '<li class="page-item ' . $clase . '"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
        }

        if ($fin < $ultimaPagina) {
            $paginacion .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            $paginacion .= '<li class="page-item"><a class="page-link" href="?pagina=' . $ultimaPagina . '">' . $ultimaPagina . '</a></li>';
        }

        $clase = ($pagina == $ultimaPagina) ? "disabled" : "";
        $paginacion .= '<li class="page-item ' . $clase . '"><a class="page-link" href="?pagina=' . ($pagina + 1) . '">&raquo;</a></li>';

        $paginacion .= '</ul>';

        if($total>0)
        echo $paginacion;
    }

    private function printSesion()
    {
        if (isset($_SESSION['usuarioDatos'])) {
            $nombreUsu = $_SESSION['usuarioDatos']['nombre'] ?? 'Usuario';
            echo "
            <li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle\" href=\"http://example.com\" id=\"dropdown04\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">" . $nombreUsu . "</a>
                <div class=\"dropdown-menu\" aria-labelledby=\"dropdown04\">
                    <a class=\"dropdown-item\" href=\"?paso=info\">Información personal</a>
                    <a class=\"dropdown-item\" href=\"?cerrarSesion=true\">Cerrar sesión</a>
                </div>
            </li>";
        } else
            echo "
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"?paso=iniciar\">Iniciar sesión</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"?paso=registrar\">Registrarse</a>
            </li>";
    }

    private function printProducto($id)
    {
        $bbdd = new BBDD();
        $producto = $bbdd->getProducto($id);
        unset($bbdd);

        if ($producto != null)
            echo "<div  class=\"col-6\">
        <img class=\"h-50  mx-auto d-block\" src=\"img\\{$producto->rutaImg}\" alt=\"\">
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

    private function printDireccionEnvio()
    {
        $bbdd = new BBDD();
        $direcciones = $bbdd->getDirecciones($_SESSION['usuarioDatos']['correo']);
        unset($bbdd);

        if ($direcciones != null)
            foreach ($direcciones as $direccion)
                echo "<option value='{$direccion->id}'>{$direccion->ciudad}, {$direccion->calle} {$direccion->piso}</option>";
    }

    private function printMetodoPago()
    {
        $bbdd = new BBDD();
        $pagos = $bbdd->getPagos($_SESSION['usuarioDatos']['correo']);
        unset($bbdd);

        if ($pagos != null)
            foreach ($pagos as $pago) {
                $numero = str_split($pago->numero, 4)[0];
                echo "<option value='{$pago->id}'>{$numero} **** **** ****</option>";
            }
    }
    private function printErrorLogin()
    {
        if (isset($_SESSION['errorLog'])) {
            echo "<div class='text-danger pb-3'>{$_SESSION['errorLog']}</div>";
            unset($_SESSION['errorLog']);
        }
    }
    private function prinErrorRegistrar()
    {
        if (isset($_SESSION['errorReg'])) {
            echo "<div class='text-danger pb-3'>{$_SESSION['errorReg']}</div>";
            unset($_SESSION['errorReg']);
        }
    }
    public function run($p = null)
    {
        //Cerrar sesion
        if (isset($_REQUEST['cerrarSesion']) && isset($_SESSION['usuarioDatos'])) {
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

        //Eliminar direccion
        if (isset($_REQUEST['deleteDireccion']) && isset($_REQUEST['slcDireccion']) && isset($_SESSION['usuarioDatos']['correo'])) {
            $bbdd = new BBDD();
            $exito = $bbdd->deleteDireccion($_REQUEST['slcDireccion'], $_SESSION['usuarioDatos']['correo']);
            unset($bbdd);
            header("Location: index.php?paso={$_SESSION['ultimoPaso']}");
        }

        //Añadir direccion
        if (isset($_SESSION['usuarioDatos']['correo']) && isset($_REQUEST['inputPais']) && isset($_REQUEST['inputProvincia']) && isset($_REQUEST['inputCiudad']) && isset($_REQUEST['inputCalle']) && isset($_REQUEST['inputNumero'])) {
            $bbdd = new BBDD();
            $exito = $bbdd->setDireccion(new Direccion('', $_SESSION['usuarioDatos']['correo'], $_REQUEST['inputPais'], $_REQUEST['inputProvincia'], $_REQUEST['inputCiudad'], $_REQUEST['inputCalle'], $_REQUEST['inputNumero']));
            unset($bbdd);
            header("Location: index.php?paso={$_SESSION['ultimoPaso']}");
        }

        //Eliminar pago
        if (isset($_REQUEST['deletePago']) && isset($_REQUEST['slcPago']) && isset($_SESSION['usuarioDatos']['correo'])) {
            $bbdd = new BBDD();
            $exito = $bbdd->deletePago($_REQUEST['slcPago'], $_SESSION['usuarioDatos']['correo']);
            unset($bbdd);
            header("Location: index.php?paso={$_SESSION['ultimoPaso']}");
        }

        //Añadir pago
        if (isset($_SESSION['usuarioDatos']['correo']) && isset($_REQUEST['inputTitular']) && isset($_REQUEST['inputNumero']) && isset($_REQUEST['inputCaducidad']) && isset($_REQUEST['inputNumeroSecreto'])) {
            $bbdd = new BBDD();
            $exito = $bbdd->setPago(new Pago('', $_SESSION['usuarioDatos']['correo'], $_REQUEST['inputTitular'], $_REQUEST['inputNumero'], $_REQUEST['inputCaducidad'], $_REQUEST['inputNumeroSecreto']));
            unset($bbdd);
            header("Location: index.php?paso={$_SESSION['ultimoPaso']}");
        }

        $this->printHead();

        if (isset($_REQUEST["hdnProducto"]))
            $_REQUEST["paso"] = "producto";

        $this->printBody();

        $this->printFoot();
    }
}
