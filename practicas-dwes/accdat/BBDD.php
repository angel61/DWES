<?php
    require_once("accdat/constantesDB.php");
function validarUsuario(string $us,string $pw):bool {

    $validado = false;
    $tipo = "e";

    @$conn=mysqli_connect(host,us,pw,bd);
    if($conn){
        $query="select tipo from usuarios where usuario='$us' and clave='$pw'";
        $rest=mysqli_query($conn,$query);
        if(mysqli_num_rows($rest)==1){
            $validado=true;
            $row=mysqli_fetch_assoc($rest);
            $tipo=$row['tipo'];
        }
        mysqli_close($conn);
    }
    
//     if ($us === "a" && $pw === "a") $validado = true;
    
    if($validado){$_SESSION['usuario']=$us;$_SESSION['tipo']=$tipo;}
    else{unset($_SESSION['usuario']);unset($_SESSION['tipo']);} 
    return $validado;
}


function acceso($tipo){
    $us = $_REQUEST['txtUser'] ?? "";
    $pw = $_REQUEST['txtPass'] ?? "";
    $usuAnt = $_SESSION['usuario'] ?? "";
    $usuTipo = $_SESSION['tipo'] ?? "";
    if($tipo==="e"){
        if (($usuAnt || validarUsuario($us, $pw))&&$usuTipo=="e")
            return true;
        else
            return false;
    }else{
        if (($usuAnt || validarUsuario($us, $pw)))
            return true;
        else
            return false;
    }
}

function importarCSV(string $file, string $tbl):void{
    //echo file_get_contents($file);

    @$conn=mysqli_connect(host,us,pw,bd);
    if($conn){
        $query="LOAD DATA LOCAL INFILE '$file' INTO TABLE $tbl";
        $rest=mysqli_query($conn,$query);
        if(!mysqli_errno($rest))
            echo "Carga completa";
        else
            echo "Fallo de carga:".mysqli_error();
        mysqli_close($conn);
    }
}
