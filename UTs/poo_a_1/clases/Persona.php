<?php


class Persona
{
    public $dni;
    public $nombre;
    public $ap1;
    public $ap2;
    public $tipovia;
    public $direccion;

    private function comprobar($valor){
        return trim(addslashes(htmlspecialchars($valor)));
    }

    public function __construct($dni,$nombre,$ap1,$ap2,$tipovia,$direccion)
    {
        $this->dni=$this->comprobar($dni);
        $this->nombre=$this->comprobar($nombre);
        $this->ap1=$this->comprobar($ap1);
        $this->ap2=$this->comprobar($ap2);
        $this->tipovia=$this->comprobar($tipovia);
        $this->direccion=$this->comprobar($direccion);
    }
}