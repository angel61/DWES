<?php
    /*
     * Si se ha seleccionado algun alumno en el select se mostraran sus datos
     * en el div que se encuentra debajo del select
     */
    if(isset($_POST["seleccion"])){
        $arrayAux=$_SESSION['gestion'][htmlspecialchars($_POST["seleccion"])];
        foreach($arrayAux as $valor)
            echo $valor."<br>";
    }