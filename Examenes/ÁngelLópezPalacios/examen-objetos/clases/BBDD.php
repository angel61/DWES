<?php

class BBDD
{
    private const SRV = 'localhost';
    private const USR = 'root';
    private const PWD = '';
    private const BBDD = 'examen_alp';
    private const TBL = 'usuario';
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

    public function comprobarUsuario($usuario = null, $tbl = self::TBL)
    {
        $ret = false;
        $tipo = "i";

        if ($usuario instanceof Usuario) {
            $pwMD5 = md5($usuario->nombre . "-" . $usuario->pass);

            $sql = "select tipo from {$tbl} where usuario='$usuario->nombre' and clave='$pwMD5'";
            $result = $this->bbdd->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $tipo = $row['tipo'];
            }
        }
        if ($ret) {
            $_SESSION['usuario'] = $us;
            $_SESSION['tipo'] = $tipo;
        }
        return $ret;
    }

    public function annadirUsuario($usuario = null, $tbl = self::TBL)
    {
        $ret = null;
        if ($usuario instanceof Usuario) {
            $passMD5 = md5($usuario->nombre . "-" . $usuario->pass);
            $sql = "INSERT INTO usuarios(usuario, clave, correo, tipo) VALUES (?,?,?,?)";
            $stmt = $this->bbdd->prepare($sql);
            $stmt->bind_param("ssss", $usuario->nombre, $passMD5, $usuario->correo, 'u');

            $ret = $stmt->execute();
        }
        return $ret;
    }
}
