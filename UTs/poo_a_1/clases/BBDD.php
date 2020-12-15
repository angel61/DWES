<?php
class BBDD
{
    const host = "localhost";
    const us = "root";
    const pw = "";
    const bd = "poo";
    const puerto = 3306;

    public function __construct()
    {
    }

    function getTipoVia()
    {
        $tipoVia = [];
        @$conn = new mysqli(host, us, pw, bd);
        if ($conn) {
            $sql = "select * from tipovia";
            $rest = $conn->query($sql);
            while ($row = $rest->fetch_assoc()) {
                $tipoVia[$row['cod']] = $row['descri'];
            }
            $conn->close();
        }
        return $tipoVia;
    }

    public function setUsuario(Persona $persona)
    {
        $retorno = false;
        @$conn = new mysqli(host, us, pw, bd);
        if ($conn) {
            $query = "INSERT INTO personas(dni, nombre, ap1, ap2, tipovia, direccion) VALUES (?,?,?,?,?,?)";
            $sentencia = $conn->stmt_init();
            $sentencia->prepare($query);
            $sentencia->bind_param("isssss", $persona->dni, $persona->nombre, $persona->ap1, $persona->ap2, $persona->tipovia, $persona->direccion);
            $retorno = $sentencia->execute();
            $conn->close();
        }
        return $retorno;
    }
}
