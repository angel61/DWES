<?php
class Rectangulo
{
    private $alto;
    private $ancho;

    public function __CONSTRUCT($ancho, $alto)
    {
        $this->ancho = $ancho;
        $this->alto = $alto;
    }

    public function getAlto()
    {
        return $this->alto;
    }
    public function getAncho()
    {
        return $ancho;
    }
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;
    }
    public function setAlto($alto)
    {
        $this->alto = $alto;
    }

    public function __toString(){
        return "{Alto:{$this->alto}, Ancho:{$this->ancho}}";
    }
}

$objeto=new Rectangulo(1,2);
echo $objeto->getAlto();
echo $objeto->__toString();