<?php

class BBDD
{
    private const SRV = 'localhost';
    private const USR = 'root';
    private const PWD = '';
    private const BBDD = 'tienda';
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

    public function getProductos()
    {
        $ret = null;
        $sql = "SELECT * FROM producto";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[] = new Producto($row['ID_producto'], $row['nombre'], $row['descripcion'], $row['precio'], $row['stock'], $row['descuento'], $row['ruta_imagen']);

        return $ret;
    }

    public function getProducto($id = -1)
    {
        $ret = null;
        $sql = "SELECT * FROM producto where ID_producto=" . $id;
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret = new Producto($row['ID_producto'], $row['nombre'], $row['descripcion'], $row['precio'], $row['stock'], $row['descuento'], $row['ruta_imagen']);

        return $ret;
    }

    public function getUsuario($correo = null)
    {
        $ret = null;
        if ($correo != null) {
            $sql = "SELECT * FROM usuario where correo='{$correo}'";
            $result = $this->bbdd->query($sql);
            while ($row = $result->fetch_assoc())
                $ret = new Usuario($row['nombre'], $row['apellidos'], $row['correo'], null, $row['tipo']);
        }
        return $ret;
    }
    public function login($usu, $pass)
    {
        $ret = null;
        $passMD5 = md5($usu . "-" . $pass);
        $sql = "SELECT * FROM usuario where clave='$passMD5'";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret = new Usuario($row['nombre'], $row['apellidos'], $row['correo'], null, $row['tipo']);
        return $ret;
    }

    public function setUsuario($usuario, $tipo = 'u')
    {
        $ret = null;
        $passMD5 = md5($usuario->correo . "-" . $usuario->clave);
        if ($usuario instanceof Usuario) {
            $sql = "INSERT INTO usuario (nombre,apellidos,correo,clave,tipo) VALUES (?,?,?,?,?)";
            $stmt = $this->bbdd->prepare($sql);
            $stmt->bind_param("sssss", $usuario->nombre, $usuario->apellidos, $usuario->correo, $passMD5, $tipo);

            $ret = $stmt->execute();
        }
        return $ret;
    }
    public function updatePersona($persona, $tbl = self::TBL)
    {
        $ret = null;
        if ($persona instanceof Persona) {
            $sql = "UPDATE {$tbl} SET 
                nombre='{$persona->nombre}',
                ap1='{$persona->ap1}',
                ap2='{$persona->ap2}',
                tipovia='{$persona->tipovia}',
                direccion='{$persona->direccion}'
            WHERE dni='{$persona->dni}'";
            $ret = $this->bbdd->query($sql);
        }
        return $ret;
    }
}
