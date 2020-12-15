<?php

class Titulo
{
    private $texto="";
    private $posicion="center";
    private $colorTexto="black";
    private $colorFondo="white";

    public function __CONSTRUCT(...$valores)
    {
        switch (count($valores)) {
            case 4:
                    $this->texto = $valores[0];
                    $this->posicion = $valores[1];
                    $this->colorTexto = $valores[2];
                    $this->colorFondo = $valores[3];
                break;
        }
    }
    public function mostrar()
    {
        echo "<h1 width='100%' style='color:".$this->colorTexto.
            "; background-color:".$this->colorFondo.
            "; text-align:".$this->posicion.
            ";'>".$this->texto."</h1>";
    }
    public function __get($name)
    {
        switch ($name){
            case "texto":
            case "posicion":
            case "colorFondo":
            case "colorTexto": return $this->$name;
            default: return null;
    }
    }
    public function __set($name, $value)
    {
        if(isset($this->$name) && gettype($this->$name)==gettype($value)) {
            switch ($name) {
                case "texto":
                case "posicion":
                case "colorFondo":
                case "colorTexto":
                    $this->$name=$value;
                    break;
                default:
                    break;
            }
        }
    }
}

$titulo1=new Titulo();
$titulo1->texto="texto1";
$titulo1->mostrar();
$titulo1->texto="texto2";
$titulo1->posicion="right";
$titulo1->colorFondo="red";
$titulo1->colorTexto="white";
$titulo1->mostrar();