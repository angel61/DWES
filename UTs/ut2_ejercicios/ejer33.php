<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ejer33.php" method="post">
    <?php
    echo "<table><tr>";
    for($i=1;$i<=10;$i++){
    echo "<td><fieldset>
            <legend>Alumno$i</legend>
            <table>
                <tr><td>Nombre:</td><td><input type=\"text\" name=\"nombre[]\"></td></tr>
                <tr><td>Apellidos:</td><td><input type=\"text\" name=\"apellidos[]\"></td></tr>
                <tr><td>Curso:</td><td><input type=\"text\" name=\"curso[]\"></td></tr>
                <tr><td>Edad:</td><td><input type=\"number\" name=\"edad[]\"></td></tr>
                <tr><td>Localidad:</td><td><input type=\"text\" name=\"localidad[]\"></td></tr>
            </table>
        </fieldset></td>";
        if($i==5)echo "</tr><tr>";
    }
    echo "</tr></table>";
        ?>
        <input type="submit"><br>
        <?php
            if(isset($_POST["nombre"][0])){
                $apellidos=$_POST["apellidos"];
                for($i=0;$i<10;$i++){
                    $datos[]=array(
                        "nombre" => $_POST["nombre"][$i],
                        "apellidos" => $_POST["apellidos"][$i],
                        "curso" => $_POST["curso"][$i],
                        "edad" => $_POST["edad"][$i],
                        "localidad" => $_POST["localidad"][$i]
                    );
                }
                array_multisort($apellidos, SORT_ASC, $datos);
                echo "<table>";
                for($i=0;$i<10;$i++){
                echo "<tr><td>{$datos[$i]["nombre"]}</td><td>{$datos[$i]["apellidos"]}</td><td>{$datos[$i]["curso"]}</td><td>{$datos[$i]["edad"]}</td><td>{$datos[$i]["localidad"]} </td></tr>";
            }
            echo "</table>";
            }
        ?>
    </form>
</body>
</html>