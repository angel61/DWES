<?php
function validarUsuario(string $us,string $pw):bool {
    require_once("accdat/constantesDB.php");

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
