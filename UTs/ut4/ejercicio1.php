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

$empleado1=new Empleado();
$empleado2=new Empleado("ivan");
$empleado3=new Empleado(124.23);
$empleado4=new Empleado("manolo",123);
$empleado6=new Empleado(123,"manolo2");
$empleado5=new Empleado("manolo",123,1,1,1,1);
$empleado7=clone $empleado4;

echo $empleado1."<br>";
echo $empleado2."<br>";
echo $empleado3."<br>";
echo $empleado4."<br>";
echo $empleado5."<br>";
echo $empleado6."<br>";
echo $empleado7."<br>";

echo $empleado1->nombre.".<br>";
echo $empleado1->sueldo.".<br>";
echo $empleado1->algo.".<br>";

$empleado1->nombre=1;
echo $empleado1." - 1<br>";

$empleado1->nombre="1";
echo $empleado1." - 2<br>";


$empleado1->puesto="1";
echo $empleado1." - 3<br>";


$empleado1->numEmpleadoAnonimo="1";
echo $empleado1." - 4<br>";