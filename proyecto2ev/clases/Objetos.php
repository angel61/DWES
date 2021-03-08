<?php

class Producto
{
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;
    public $descuento;
    public $rutaImg;

    private function convert($p){
        return addslashes(trim(htmlspecialchars($p)));
    }

    public function __construct($id='',$nombre='',$descripcion='',$precio='',$stock='',$descuento='',$rutaImg=''){
        if (!is_numeric($id)) $id=0;
        $this->id = $id;
        $this->nombre = $this->convert($nombre);
        $this->descripcion = $this->convert($descripcion);
        $this->precio = $this->convert($precio);
        $this->stock = $this->convert($stock);
        $this->descuento = $this->convert($descuento);
        $this->rutaImg = $this->convert($rutaImg);
    }
}

class Usuario
{
    public $nombre;
    public $apellidos;
    public $correo;
    public $clave;
    public $tipo;

    private function convert($p){
        return addslashes(trim(htmlspecialchars($p)));
    }

    public function __construct($nombre='',$apellidos='',$correo='',$clave='',$tipo=''){
        $this->nombre = $this->convert($nombre);
        $this->apellidos = $this->convert($apellidos);
        $this->correo = $this->convert($correo);
        $this->clave = $this->convert($clave);
        $this->tipo = $this->convert($tipo);
    }
}

class Direccion
{
    public $id;
    public $correo;
    public $pais;
    public $provincia;
    public $ciudad;
    public $calle;
    public $piso;

    private function convert($p){
        return addslashes(trim(htmlspecialchars($p)));
    }

    public function __construct($id='',$correo='',$pais='',$provincia='',$ciudad='',$calle='',$piso=''){
        if (!is_numeric($id)) $id=0;
        $this->id = $id;
        $this->correo = $this->convert($correo);
        $this->pais = $this->convert($pais);
        $this->provincia = $this->convert($provincia);
        $this->ciudad = $this->convert($ciudad);
        $this->calle = $this->convert($calle);
        $this->piso = $this->convert($piso);
    }
}

class Pago
{
    public $id;
    public $correo;
    public $titular;
    public $numero;
    public $caducidad;
    public $numSecreto;

    private function convert($p){
        return addslashes(trim(htmlspecialchars($p)));
    }

    public function __construct($id='',$correo='',$titular='',$numero='',$caducidad='',$numSecreto=''){
        if (!is_numeric($id)) $id=0;
        $this->id = $id;
        $this->correo = $this->convert($correo);
        $this->titular = $this->convert($titular);
        $this->numero = $this->convert($numero);
        $this->caducidad = $this->convert($caducidad);
        $this->numSecreto = $this->convert($numSecreto);
    }
}

class Compra
{
    public $id;
    public $idPago;
    public $idProducto;
    public $idDireccion;
    public $correo;
    public $cantidad;
    public $proceso;

    private function convert($p){
        return addslashes(trim(htmlspecialchars($p)));
    }

    public function __construct($id='',$idPago='',$idProducto='',$idDireccion='',$correo='',$cantidad='',$proceso=''){
        if (!is_numeric($id)) $id=0;
        $this->id = $id;
        if (!is_numeric($idPago)) $idPago=0;
        $this->idPago = $idPago;
        if (!is_numeric($idProducto)) $idProducto=0;
        $this->idProducto = $idProducto;
        if (!is_numeric($idDireccion)) $idDireccion=0;
        $this->idDireccion = $idDireccion;
        $this->correo = $this->convert($correo);
        if (!is_numeric($cantidad)) $cantidad=1;
        $this->cantidad = $cantidad;
        $this->proceso = $this->convert($proceso);
    }
}