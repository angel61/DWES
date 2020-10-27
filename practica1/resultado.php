<?php
    if(isset($_POST["seleccion"])){
        $arrayAux=$_SESSION[htmlspecialchars($_POST["seleccion"])];
        foreach($arrayAux as $valor)
            echo $valor."<br>";
    }