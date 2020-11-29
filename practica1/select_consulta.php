<?php
    /*
     * Se carga en el select los alumnos que se encuentren en el array de gestion de la sesion
     */
    foreach($_SESSION['gestion'] as $clave => $valor)
        echo "<option>".$clave."</option>";