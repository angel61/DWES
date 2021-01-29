<?php

class BBDD
{
    private const SRV = 'localhost';
    private const USR = 'root';
    private const PWD = '';
    private const BBDD = 'usuarios_servicios';
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

    function nuevoToken($token, $usuario, $pass)
    {
        $sql = "UPDATE `usuarios` SET `token`=? WHERE nombre=? AND clave=?";
        $stmt = $this->bbdd->prepare($sql);
        $stmt->bind_param('sss', $token, $usuario, $pass);
        $stmt->execute();
        return $stmt->affected_rows;
    }
    function validarToken($token)
    {
        $retorno = false;
        $sql = "SELECT nombre FROM `usuarios` WHERE token='$token'";
        $rest = $this->bbdd->query($sql);
        $retorno = $rest->num_rows===1;
        return $retorno;
    }
}
