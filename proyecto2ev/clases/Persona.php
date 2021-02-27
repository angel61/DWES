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