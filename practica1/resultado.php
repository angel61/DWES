<?php
    if(isset($_POST["seleccion"])){
        $arrayAux=$_SESSION['gestion'][htmlspecialchars($_POST["seleccion"])];
        foreach($arrayAux as $valor)
            echo $valor."<br>";
    }