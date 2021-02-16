<?php

class BBDD
{
    private const SRV = 'localhost';
    private const USR = 'root';
    private const PWD = '';
    private const BBDD = 'nba';
    private const TBL = 'equipos';
    private const TBL2 = 'jugadores';
    private $bbdd;

    public function __construct()
    {
        $this->bbdd = new mysqli();
        try {
            $this->bbdd->connect(self::SRV, self::USR, self::PWD, self::BBDD);
            $this->bbdd->query("SET NAMES 'utf8'");
        } catch (Exception $e) {
            $this->bbdd = null;
            throw new Exception("Error de conexión:" . $e->getMessage());
        }
    }

    public function __destruct()
    {
        if (!$this->bbdd) $this->bbdd->close();
        $this->bbdd = null;
    }

    function getConferencias($tbl = self::TBL)
    {
        $conferencias = [];
            $sql = "SELECT Conferencia FROM {$tbl} GROUP BY Conferencia";
            $rest = $this->bbdd->query($sql);
            while ($row = $rest->fetch_assoc())
                $conferencias[] = $row['Conferencia'];
        return $conferencias;
    }

    function getEquipos($conferencia, $tbl = self::TBL)
    {
        $equipos = [];
        $sql = "SELECT Nombre FROM {$tbl} WHERE Conferencia='{$conferencia}'";
        $rest = $this->bbdd->query($sql);
        while ($row = $rest->fetch_assoc())
            $equipos[] = $row['Nombre'];
        return $equipos;
    }

    function getJugadores($equipo, $tbl = self::TBL2)
    {
        $jugadores = [];
        $sql = "SELECT codigo, Nombre, Procedencia, Altura, Peso, Posicion, Nombre_equipo FROM {$tbl} WHERE Nombre_equipo='{$equipo}'";
        $rest = $this->bbdd->query($sql);
        while ($row = $rest->fetch_assoc())
            $jugadores[] = [$row['codigo'],$row['Nombre'],$row['Procedencia'],$row['Altura'],$row['Peso'],$row['Posicion'],$row['Nombre_equipo']];

        return $jugadores;
    }

}
