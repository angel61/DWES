<?php

class Empleado
{
    private $nombre;
    private $sueldo;
    private static $numEmpleadoAnonimo=0;

    public function __CONSTRUCT(...$valores)
    {
        switch (count($valores)) {
            case 1:
                if (is_numeric($valores[0])) {
                    self::$numEmpleadoAnonimo++;
                    $this->sueldo = $valores[0];
                    $this->nombre = "Empleado" . self::$numEmpleadoAnonimo;
                } else {
                    $this->nombre = $valores[0];
                    $this->sueldo = 0;
                }
                break;
            case 2:
                if (is_numeric($valores[0])) {
                    $this->nombre = $valores[1];
                    $this->sueldo = $valores[0];
                } else {
                    $this->nombre = $valores[0];
                    $this->sueldo = $valores[1];
                }
                break;
            default:
                self::$numEmpleadoAnonimo++;
                $this->nombre = "Empleado" . self::$numEmpleadoAnonimo;
                $this->sueldo = 0;
                break;
        }
    }
    public function __toString()
    {
        return $this->nombre." - ".$this->sueldo;
    }

    public function __clone()
    {
        self::$numEmpleadoAnonimo++;
        $this->nombre = "Empleado" . self::$numEmpleadoAnonimo;
    }
    public function __get($name)
    {
        switch ($name){
            case "nombre":
            case "sueldo": return $this->$name;
            case "numEmpleadoAnonimo": return self::$numEmpleadoAnonimo;
            default: return null;
    }
    }
    public function __set($name, $value)
    {
        if(isset($this->$name) && gettype($this->$name)==gettype($value)) {
            switch ($name) {
                case "nombre":
                case "sueldo":
                    $this->$name=$value;
                    break;
                default:
                    break;
            }
        }
    }
}

class Empleados implements Iterator {
    private $position = 0;
    private $array = array();  

    public function __construct() { $this->position = 0;  }
    public function rewind() { $this->position = 0; }
    public function add($valor) { $this->array[]=$valor; }
    public function current() {return $this->array[$this->position]; }
    public function key() {return $this->position; }
    public function next() {++$this->position; }
    public function valid() {return isset($this->array[$this->position]); }
}


$empleado1=new Empleado();
$empleado2=new Empleado("ivan");
$empleado3=new Empleado(124.23);
$empleado4=new Empleado("manolo",123);
$empleado6=new Empleado(123,"manolo2");
$empleado5=new Empleado("manolo",123,1,1,1,1);
$empleado7=clone $empleado4;

$it = new Empleados;
$it->add($empleado1);
$it->add($empleado2);
$it->add($empleado3);


foreach($it as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}