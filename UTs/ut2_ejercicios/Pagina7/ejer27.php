<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <?php
            $distancias=array(
                'Barcelona' => array(
                    'Barcelona' => 0,
                    'Coruña' => 1188,
                    'Madrid' => 621,
                    'Sevilla' => 1046),
                'Coruña' => array(
                    'Barcelona' => 1188,
                    'Coruña' => 0,
                    'Madrid' => 609,
                    'Sevilla' => 947),
                'Madrid' => array(
                    'Barcelona' => 621,
                    'Coruña' => 609,
                    'Madrid' => 0,
                    'Sevilla' => 538),
                'Sevilla' => array(
                    'Barcelona' => 1046,
                    'Coruña' => 947,
                    'Madrid' => 538,
                    'Sevilla' => 0)
            );
        ?>
</head>
<body>
    
    <form action="ejer27.php" method="post">
        <select name="ubicacion1">
            <option value="Barcelona" selected>Barcelona</option> 
            <option value="Coruña">Coruña</option>
            <option value="Madrid">Madrid</option>
            <option value="Sevilla">Sevilla</option>
        </select><br>
        <select name="ubicacion2">
            <option value="Barcelona" selected>Barcelona</option> 
            <option value="Coruña">Coruña</option>
            <option value="Madrid">Madrid</option>
            <option value="Sevilla">Sevilla</option>
        </select><br>
        <input type="submit">
    </form>
    <br><br>
    <?php
        if(isset($_POST["ubicacion1"])&&isset($_POST["ubicacion2"])){
            $val1=$_POST["ubicacion1"];
            $val2=$_POST["ubicacion2"];
            $distancisFinal=$distancias[$val1][$val2];
            echo "La distancia es de $distancisFinal";
        }
    ?>
</body>
</html>