<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $correo;
    public $tipo;

    private function convert($p){
        return addslashes(trim(htmlspecialchars($p)));
    }

    public function __construct($nombre='',$pass='',$correo='',$tipo=''){
        $this->nombre = $this->convert($nombre);
        $this->pass = $this->convert($pass);
        $this->correo = $this->convert($correo);
        $this->tipo = $this->convert($tipo);
    }
}