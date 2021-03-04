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

    /* Inicio tabla producto */
    public function getProductos($palabrasClave='',$pagina=1,$limite=12)
    {
        $ret = null;
        $sql = "SELECT * FROM producto WHERE stock > 0";
        
        if(strlen($palabrasClave)>0){
            $palabrasClave=$this->bbdd->real_escape_string($palabrasClave);
            $arrayPalabras = explode(" ", $palabrasClave);
            $sql .= " AND nombre like '%".$arrayPalabras[0]."%' OR descripcion like '%" . $arrayPalabras[0] . "%'";
            
           for($i = 1; $i < count($arrayPalabras); $i++) 
              if(!empty($arrayPalabras[$i])) 
                  $sql .= " OR nombre like '%" . $arrayPalabras[$i] . "%' OR descripcion like '%" . $arrayPalabras[$i] . "%'";
        }
        $pagina=($pagina-1)*$limite;
        $sql.=" LIMIT $pagina,$limite";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[] = new Producto($row['ID_producto'], $row['nombre'], $row['descripcion'], $row['precio'], $row['stock'], $row['descuento'], $row['ruta_imagen']);

        return $ret;
    }
    public function getTotalProductos($palabrasClave='')
    {
        $ret = null;
        $sql = "SELECT count(nombre) as numero_filas FROM producto WHERE stock > 0";
        
        if(strlen($palabrasClave)>0){
            $palabrasClave=$this->bbdd->real_escape_string($palabrasClave);
            $arrayPalabras = explode(" ", $palabrasClave);
            $sql .= " AND nombre like '%".$arrayPalabras[0]."%' OR descripcion like '%" . $arrayPalabras[0] . "%'";
            
           for($i = 1; $i < count($arrayPalabras); $i++) 
              if(!empty($arrayPalabras[$i])) 
                  $sql .= " OR nombre like '%" . $arrayPalabras[$i] . "%' OR descripcion like '%" . $arrayPalabras[$i] . "%'";
        }
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret = $row['numero_filas'];

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
    /* Fin tabla producto */

    /* Inicio tabla usuario */
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

    public function setUsuario($usuario=null, $tipo = 'u')
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
    /* Fin tabla usuario */

    /* Inicio tabla direccion */
    public function getDirecciones($correo='')
    {
        $ret = null;
        $sql = "SELECT * FROM direccion WHERE correo='$correo'";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[] = new Direccion($row['ID_direccion'], $row['correo'], $row['pais'], $row['provincia'], $row['ciudad'], $row['calle'], $row['piso']);

        return $ret;
    }

    public function deleteDireccion($id=0,$correo='')
    {
        $ret = null;
            $sql = "DELETE FROM `direccion` WHERE ID_direccion=? AND correo like ?";
            $stmt = $this->bbdd->prepare($sql);
            $stmt->bind_param("is", $id, $correo);

            $ret = $stmt->execute();
        return $ret;
    }

    public function setDireccion($direccion=null)
    {
        $ret = null;
        if ($direccion instanceof Direccion) {
            $sql = "INSERT INTO direccion (correo,pais,provincia,ciudad,calle,piso) VALUES (?,?,?,?,?,?)";
            $stmt = $this->bbdd->prepare($sql);
            $stmt->bind_param("sssssi", $direccion->correo, $direccion->pais, $direccion->provincia, $direccion->ciudad, $direccion->calle,$direccion->piso);

            $ret = $stmt->execute();
        }
        return $ret;
    }
    /* Fin tabla direccion */

    /* Inicio tabla pagos */
    public function getPagos($correo='')
    {
        $ret = null;
        $sql = "SELECT * FROM pago WHERE correo='$correo'";
        $result = $this->bbdd->query($sql);
        while ($row = $result->fetch_assoc())
            $ret[] = new Pago($row['ID_pago'],$row['Correo'], $row['Titular'], $row['Numero'], $row['Caducidad'], $row['Num_secreto']);

        return $ret;
    }

    public function deletePago($id=0,$correo='')
    {
        $ret = null;
            $sql = "DELETE FROM `pago` WHERE ID_pago=? AND correo like ?";
            $stmt = $this->bbdd->prepare($sql);
            $stmt->bind_param("is", $id, $correo);

            $ret = $stmt->execute();
        return $ret;
    }

    public function setPago($pago=null)
    {
        $ret = null;
        if ($pago instanceof Pago) {
            $sql = "INSERT INTO pago (Correo,Titular,Numero,Caducidad,Num_secreto) VALUES (?,?,?,?,?)";
            $stmt = $this->bbdd->prepare($sql);
            $stmt->bind_param("ssisi", $pago->correo, $pago->titular, $pago->numero, $pago->caducidad, $pago->numSecreto);

            $ret = $stmt->execute();
        }
        return $ret;
    }
    /* Fin tabla pagos */
}
