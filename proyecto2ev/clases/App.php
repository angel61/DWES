<?php


class App
{
    //Funcion para añadir la cabecera a la web
    private function printHead()
    {
        include_once("gui/head.php");
    }

    //Funcion para añadir la parte de la web que se quiere visualizar
    private function printBody($paso)
    {
        $vistaProducto = $paso == "producto";
        $finalizarPago = $paso == "finalizarCompra" && isset($_SESSION['usuarioDatos']);;
        $pasoInicio = ($paso == "iniciar" && !isset($_SESSION['usuarioDatos'])) || ($paso == "finalizarCompra" && !$finalizarPago);
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
            case $finalizarPago:
                include_once("gui/finalizarPago.php");
                break;
            default:
                include_once("gui/listado_productos.php");
                break;
        }
    }

    //Funcion para añadir el pie a la web
    private function printFoot()
    {
        include_once("gui/foot.html");
    }

    //Funcion que muestra en la web un listado de productos segun si se hizo una busqueda o no
    public function printProductos()
    {
        $busqueda = $_REQUEST["inpBusqueda"] ?? "";
        $pagina = $_REQUEST['pagina'] ?? 1;
        $limite = $_REQUEST['limite'] ?? 12;
        $bbdd = new BBDD();
        $productos = $bbdd->getProductos($busqueda, $pagina, $limite);
        unset($bbdd);

        //Si la consulta sql devuelve el listado de producto se muestran
        //Si no devuelve nada se muestra un mensaje
        if ($productos != null) {
            //Se guardan las palabras clave de la busqueda para en el caso de que se pase pagina no se pierda la consulta
            echo "<input type='hidden' value='$busqueda' name='inpBusqueda'>";
            foreach ($productos as $producto) {
                $precio = number_format($producto->precio, 2, ',', '.') . "€";
                $precioAnterior = "";
                if ($producto->descuento > 0) {
                    $precioAnterior = $precio;
                    $precio = number_format(($producto->precio * (1 - ($producto->descuento / 100))), 2, ',', '.') . "€";
                }

                echo '<div class="col-md-4 col-lg-3">
                        <div class="card card-product">
                            <div class="img-wrap"> 
                                <img src="img\\' . $producto->rutaImg . '">
                            </div>
                            <div class="info-wrap">
                                <h6 class="title text-dots"><a href="index.php?paso=producto&producto=' . $producto->id . '">' . $producto->nombre . '</a></h6>
                                <div class="action-wrap">
                                    <button class="btn btn-primary btn-sm float-right" name="comprarProducto" value="' . $producto->id . '"> Comprar </button>
                                    <div class="price-wrap h5">
                                        <span class="price-new">' . $precio . '</span>
                                        <del class="price-old">' . $precioAnterior . '</del>
                                    </div> 
                                </div>
                            </div>
                        </div> 
                    </div>';
            }
        } else
            echo "<div class='h2 text-secondary w-100 text-center pt-4'>No se encontro ningun producto.</div>";
        $this->printPaginacion($limite);
    }

    //Muestra en la web el indice de la paginacion de los productos dinamicamente
    public function printPaginacion($limite = 12)
    {
        $busqueda = $_REQUEST["inpBusqueda"] ?? "";
        $bbdd = new BBDD();
        $total = $bbdd->getTotalProductos($busqueda);
        unset($bbdd);

        $pagina = $_REQUEST['pagina'] ?? 1;
        $links = 2;

        //Se determina el numero de paginas segun el total de productos que se quieran postrar
        $ultimaPagina = ceil($total / $limite);

        //En estas dos variables se muestran la pagina del principio y otra del fin del indice
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

        if ($total > 0)
            echo $paginacion;
    }

    /*
    Esta funcion sirve segun si el usuario a logeado o no mostrar en el navbar las funciones de login y registro 
    o las de cerrar sesion y ver informacion personal
    */
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

    /*
    Muestra la vista del producto par ver informacion mas detallada
    */
    private function printProducto()
    {
        $id = $_REQUEST["producto"] ?? -1;
        $bbdd = new BBDD();
        $producto = $bbdd->getProducto($id);
        unset($bbdd);

        if ($producto != null) {
            $precio = number_format($producto->precio, 2, ',', '.') . "€";
            $precioAnterior = "";
            if ($producto->descuento > 0) {
                $precioAnterior = $precio;
                $precio = number_format(($producto->precio * (1 - ($producto->descuento / 100))), 2, ',', '.') . "€";
            }
            $stockTexto = $producto->stock > 0 ? "En stock" : "Fuera de stock";
            $stockColor = $producto->stock > 0 ? "text-success" : "text-danger";

            echo '<div class="col-sm-5 border-right d-flex align-items-center justify-content-center overflow-hidden imagen-producto">
                        <img src="img/' . $producto->rutaImg . '" alt="">
            </div>
            <div class="col-sm-7">
                <div class="card-body p-5">
                    <h2 class="title mb-3">' . $producto->nombre . '</h2>

                    <p>
                        <span class="h3">' . $precio . '</span>
                        <del class="h4 text-secondary">' . $precioAnterior . '</del>
                    </p>
                    <div class="item-property">
                        <div class="font-weight-bold">Descripción</div>
                        <div>
                            <p>' . $producto->descripcion . '</p>
                        </div>
                    </div>
                    <div class="param param-feature ' . $stockColor . '">
                        <div>' . $stockTexto . '</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="">
                                <div class="font-weight-bold">Cantidad: </div>
                                <div>
                                    <input type="number" value="1" min="1" max="' . $producto->stock . '" name="nmbCantidad">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button name="comprarProducto" value="' . $id . '" class="btn btn-lg btn-primary">Comprar</button>
                    <!--a href="#" class="btn btn-lg btn-outline-primary"> <i class="fas fa-shopping-cart"></i> Añadir al carrito </a-->
                </div>
            </div>';
        }
    }

    //Esta funcion sirve para mostrar la informacion del usuario que fue rellenada cuando se registro 
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

    //Esta funcion añade a un select las opciones de cada direccion que dispone el usuario
    private function printDireccionEnvio()
    {
        $bbdd = new BBDD();
        $direcciones = $bbdd->getDirecciones($_SESSION['usuarioDatos']['correo']);
        unset($bbdd);

        if ($direcciones != null)
            foreach ($direcciones as $direccion)
                echo "<option value='{$direccion->id}'>{$direccion->ciudad}, {$direccion->calle} {$direccion->piso}</option>";
    }

    //Esta funcion añade a un select las opciones de cada metodo de pago que dispone el usuario
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

    //Esta funcion añade a un select las opciones de cada metodo de pago que dispone el usuario
    private function printFinalizarPago()
    {
        $id = $_REQUEST["comprarProducto"] ?? -1;
        $cantidad = $_REQUEST["nmbCantidad"] ?? 1;
        $bbdd = new BBDD();
        $producto = $bbdd->getProducto($id);
        unset($bbdd);

        if ($producto != null) {
            $precio = number_format($cantidad*$producto->precio, 2, ',', '.') . "€";
            if ($producto->descuento > 0) {
                $precio = number_format($cantidad*($producto->precio * (1 - ($producto->descuento / 100))), 2, ',', '.') . "€";
            }
            echo "
            <div class='card-title h3'>Precio total: <span class='h4'>{$precio}</span></div>
            <div class='d-flex py-3'>
              <input type='hidden' name='hdnCantidad' value='{$cantidad}'>
              <button name='productoComprado' value='{$id}' class='btn btn-primary'>Finalizar pago</button>
            </div>";
        }
    }

    //Esta funcion muestra un mensaje de error en el login
    private function printErrorLogin()
    {
        if (isset($_SESSION['errorLog'])) {
            echo "<div class='text-danger pb-3'>{$_SESSION['errorLog']}</div>";
            unset($_SESSION['errorLog']);
        }
    }

    //Esta funcion muestra un mensaje de error en el registro
    private function prinErrorRegistrar()
    {
        if (isset($_SESSION['errorReg'])) {
            echo "<div class='text-danger pb-3'>{$_SESSION['errorReg']}</div>";
            unset($_SESSION['errorReg']);
        }
    }

    //Funcion que se encarga de mostrar todas la partes de la web y de su funcionalidad
    public function run($p = null)
    {
        //Cerrar sesion
        if (isset($_REQUEST['cerrarSesion']) && isset($_SESSION['usuarioDatos'])) {
            unset($_SESSION['usuarioDatos']);
            header("Location: index.php");
        }

        //Validacion del login
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

        //Validacion del registro
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

        //Realizar Compra
        if (isset($_SESSION['usuarioDatos']['correo']) && isset($_REQUEST['slcDireccion']) && isset($_REQUEST['slcPago']) && isset($_REQUEST['hdnCantidad']) && isset($_REQUEST['productoComprado'])) {
            $bbdd = new BBDD();
            try{
            $exito = $bbdd->setCompra(new Compra('', intval($_REQUEST['slcPago']), intval($_REQUEST['productoComprado']), intval($_REQUEST['slcDireccion']), $_SESSION['usuarioDatos']['correo'], intval($_REQUEST['hdnCantidad']), 'F'));
            }catch(Exception $e){
                
            }
            unset($bbdd);
            header("Location: index.php");
        }

        $this->printHead();


        if (isset($_REQUEST["comprarProducto"]))
            $_REQUEST["paso"] = "finalizarCompra";

        $paso = $_REQUEST["paso"] ?? "";
        if ($paso != "anadirDireccion" && $paso != "anadirPago")
            $_SESSION['ultimoPaso'] = $paso;
        $this->printBody($paso);

        $this->printFoot();
    }
}
