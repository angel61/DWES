<?php

class BBDD
{
    private const SRV = 'localhost';
    private const USR = 'root';
    private const PWD = '';
    private const BBDD = 'pisos';
    private const TBL = 'pisos';
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

    public function getProvincias(){
        $ret = null;
        $sql = "SELECT * FROM provincias";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[]= $row;
        return $ret;
    }

    public function getPisos($provincia){
        $ret = null;
        $sql = "SELECT tp.descri as 'tipoPiso', pr.provincia, m.nombre as 'municipio', calle, numero, cp, antiguedad, `numhabitaciones`, `numbaños`, `ascensor`, `garaje`, `trastero`, `calefaccion` 
        FROM `pisos` p, `tipospiso` tp,municipios m,provincias pr 
        WHERE tp.cod=p.`tipoPiso` and p.ciudad=pr.id_provincia and p.localidad=m.id_municipio and pr.id_provincia='{$provincia}'";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[]= $row;
        return $ret;
    }
}