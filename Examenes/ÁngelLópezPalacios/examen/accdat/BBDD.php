<?php
require_once("accdat/constantesDB.php");
function comprobarUsuario($us, $pw)
{
    $validado = false;
    $tipo = "i";

    @$conn = mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $query = "select tipo from usuarios where usuario='$us' and clave='$pw'";
        $rest = mysqli_query($conn, $query);
        if (mysqli_num_rows($rest) == 1) {
            $validado = true;
            $row = mysqli_fetch_assoc($rest);
            $tipo = $row['tipo'];
        }
        mysqli_close($conn);
    }

    if ($validado) {
        $_SESSION['usuario'] = $us;
        $_SESSION['tipo'] = $tipo;
    }
    registroActividad($us, $validado, "Inicio de sesión");
    return $validado;
}

function annadirUsuario(...$valores)
{
    $retorno = false;
    @$conn = mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $query = "INSERT INTO usuarios(usuario, clave, correo, tipo) VALUES (?,?,?,?)";
        $sentencia = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($sentencia, $query);
        mysqli_stmt_bind_param($sentencia, "ssss", $valores[0], $valores[1], $valores[2], $valores[3]);
        $retorno = mysqli_stmt_execute($sentencia);
        mysqli_close($conn);
    }
    return $retorno;
}
function editarUsuario(...$valores)
{
    $retorno = false;
    @$conn = mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $query = "UPDATE usuarios SET tipo=? WHERE usuario=?";
        $sentencia = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($sentencia, $query);
        mysqli_stmt_bind_param($sentencia, "ss", $valores[1], $valores[0]);
        $retorno = mysqli_stmt_execute($sentencia);
        mysqli_close($conn);
    }
    return $retorno;
}

function getUsuarios()
{
    $usuarios = [];
    @$conn = mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $sql = "SELECT usuario FROM usuarios";
        $rest = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($rest)) {
            $usuarios[] = $row['usuario'];
        }
        mysqli_close($conn);
    }
    return $usuarios;
}
function getListado()
{
    $usuarios = [];
    @$conn = mysqli_connect(host, us, pw, bd);
    if ($conn) {
        $sql = "SELECT * FROM usuarios";
        $rest = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($rest)) {
            $usuarios[] = [$row['usuario'], $row['correo'], $row['tipo']];
        }
        mysqli_close($conn);
    }
    return $usuarios;
}
