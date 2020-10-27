<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="ejer26.php" method="post">
        <?php
            for($i=1;$i<=6;$i++){
                echo "Contenedor $i:<input type=\"text\" name=\"contenedor$i\"><br>";
            }
        ?>
        <input type="submit">
    </form>
    <br><br>
    <?php
    if(isset($_POST["contenedor1"])){ 
        echo "<table border=\"1px\">";
        foreach($_POST as $name => $value) {
            echo "<tr><td>$name</td><td>$value</td></tr>"; 
        }
        echo "</table>";
    }
    ?>
</body>
</html>