<?php

class BBDD
{
    private const SRV = 'localhost';
    private const USR = 'root';
    private const PWD = '';
    private const BBDD = 'poo';
    private const TBL = 'personas';
    private $bbdd;

    public function __construct(){
        $this->bbdd = new mysqli();
        try{
            $this->bbdd->connect(self::SRV,self::USR,self::PWD,self::BBDD);
            $this->bbdd->query("SET NAMES 'utf8'");
        }
        catch (Exception $e){
            $this->bbdd = null;
            throw new Exception("Error de conexión:".$e->getMessage());
        }
    }

    public function __destruct(){
        if (!$this->bbdd) $this->bbdd->close();
        $this->bbdd = null;
    }

    public function getPersona($id='-1', $tbl=self::TBL){
        $ret = null;
        $sql = "SELECT * FROM {$tbl} where dni = $id";
        $result = $this->bbdd->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $ret= new Persona($row['dni'],$row['nombre'],$row['ap1'],$row['ap2'],$row['tipovia'],$row['direccion']);
        }
        return $ret;
    }

    public function getPersonas(){
        $ret = null;
        $sql = "SELECT dni, nombre FROM personas";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[]= new Persona($row['dni'],$row['nombre']);
        return $ret;
    }

    public function getTiposVias(){
        $ret = null;
        $sql = "SELECT * FROM TiposVias";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[]= $row;
        return $ret;
    }

    public function setPersona($persona, $tbl=self::TBL){
        $ret = null;
        if ($persona instanceof Persona){
            $sql = "INSERT INTO {$tbl} (dni,nombre,ap1,ap2,tipovia,direccion) VALUES (
                {$persona->dni},
                '{$persona->nombre}',
                '{$persona->ap1}',
                '{$persona->ap2}',
                '{$persona->tipovia}',
                '{$persona->direccion}'
            )";
            $ret = $this->bbdd->query($sql);
        }
        return $ret;
    }
}