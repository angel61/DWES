<?php

class Persona
{
    public $dni;
    public $nombre;
    public $ap1;
    public $ap2;
    public $tipovia;
    public $direccion;

    private function convert($p){
        return addslashes(trim(htmlspecialchars($p)));
    }

    public function __construct($dni='',$nombre='',$ap1='',$ap2='',$tipovia='',$direccion=''){
        if (!is_numeric($dni)) $dni=0;
        $this->dni = $dni;
        $this->nombre = $this->convert($nombre);
        $this->ap1 = $this->convert($ap1);
        $this->ap2 = $this->convert($ap2);
        $this->tipovia = $this->convert($tipovia);
        $this->direccion = $this->convert($direccion);
    }
}