<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="ejer25.php" method="post">
        <?php
        for($i=1;$i<=10;$i++){
        echo "Nombre $i:<input type=\"text\" name=\"nombre$i\"><br>";
        }
        ?>
        <input type="submit">
    </form><br><br>
    <?php
    if(isset($_POST["nombre1"])){ 
        echo "<table border=\"1px\">";
        for($i=1;$i<=10;$i++){
            echo "<tr><td>Alumno $i</td><td>" . $_POST["nombre$i"] . "</td></tr>";
            }
            echo "</table>";
    }
    ?>
</body>
</html>