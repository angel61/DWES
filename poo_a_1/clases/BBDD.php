<?php
    require_once("accdat/constantesDB.php");
function validarUsuario(string $us, string $pw):bool
{
    $validado = false;
    $tipo = "e";

    @$conn=mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $query="select tipo from usuarios where usuario='$us' and clave='$pw'";
        $rest=mysqli_query($conn, $query);
        if (mysqli_num_rows($rest)==1) {
            $validado=true;
            $row=mysqli_fetch_assoc($rest);
            $tipo=$row['tipo'];
        }
        mysqli_close($conn);
    }
    
//     if ($us === "a" && $pw === "a") $validado = true;
    
    if ($validado) {
        $_SESSION['usuario']=$us;
        $_SESSION['tipo']=$tipo;
    } else {
        unset($_SESSION['usuario']);
        unset($_SESSION['tipo']);
    }
    return $validado;
}


function acceso($tipo)
{
    $us = $_REQUEST['txtUser'] ?? "";
    $pw = $_REQUEST['txtPass'] ?? "";
    $usuAnt = $_SESSION['usuario'] ?? "";
    $usuTipo = $_SESSION['tipo'] ?? "";
    if ($tipo==="e") {
        if (($usuAnt || validarUsuario($us, $pw))&&$usuTipo=="e") {
            return true;
        } else {
            return false;
        }
    } else {
        if (($usuAnt || validarUsuario($us, $pw))) {
            return true;
        } else {
            return false;
        }
    }
}

function importarCSV(string $file, string $tbl):void
{
    //echo file_get_contents($file);

    @$conn=mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $query="LOAD DATA LOCAL INFILE '$file' INTO TABLE $tbl";
        $rest=mysqli_query($conn, $query);
        if (!mysqli_errno($rest)) {
            echo "Carga completa";
        } else {
            echo "Fallo de carga:".mysqli_error();
        }
        mysqli_close($conn);
    }
}

function getTipoVia()
{
    $tipoVia=[];
    @$conn=mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $sql="select * from tipovia";
        $rest=mysqli_query($conn, $sql);
        while ($row=mysqli_fetch_assoc($rest)) {
            $tipoVia[$row['cod']]=$row['descri'];
        }
        mysqli_close($conn);
    }
    return $tipoVia;
}

function annadirAlumno(...$valores)
{
    $retorno=false;
    @$conn=mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $query="INSERT INTO alumnos(nombre, apellidos, dni, fechaNacimiento, tipoVia, nombreVia, numeroVia, telefono, localidad) VALUES (?,?,?,?,?,?,?,?,?)";
        $sentencia=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($sentencia, $query);
        mysqli_stmt_bind_param($sentencia, "ssssissss", $valores[0], $valores[1], $valores[2], $valores[3], $valores[4], $valores[5], $valores[6], $valores[7], $valores[8]);
        $retorno=mysqli_stmt_execute($sentencia);
        mysqli_close($conn);
    }
    return $retorno;
}
function modificarAlumno(...$valores)
{
    $retorno=false;
    @$conn=mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $query="UPDATE alumnos SET nombre=?, apellidos=?, dni=?, fechaNacimiento=?, tipoVia=?, nombreVia=?, numeroVia=?, telefono=?, localidad=? WHERE cod=?";
        $sentencia=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($sentencia, $query);
        mysqli_stmt_bind_param($sentencia, "ssssissssi", $valores[0], $valores[1], $valores[2], $valores[3], $valores[4], $valores[5], $valores[6], $valores[7], $valores[8], $valores[9]);
        $retorno=mysqli_stmt_execute($sentencia);
        mysqli_close($conn);
    }
    return $retorno;
}
function eliminarAlumno($id)
{
    $retorno=false;
    @$conn=mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $query="DELETE FROM alumnos WHERE id=?";
        $sentencia=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($sentencia, $query);
        mysqli_stmt_bind_param($sentencia, "i", $id);
        $retorno=mysqli_stmt_execute($sentencia);
        mysqli_close($conn);
    }
    return $retorno;
}

function getNombreApellidos($nombre)
{
    $alumnos=[];
    @$conn=mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $sql="SELECT `cod`, `nombre`, `apellidos` FROM alumnos WHERE nombre='$nombre'";
        $rest=mysqli_query($conn, $sql);
        while ($row=mysqli_fetch_assoc($rest)) {
            $alumnos[$row['cod']]=$row['nombre']."/".$row['apellidos'];
        }
        mysqli_close($conn);
    }
    return $alumnos;
} 
