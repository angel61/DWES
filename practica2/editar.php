<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <?php
    require_once("accdat/accesoFicheros.php");
        if (isset($_POST["txtTitulo"])) {
            if(strlen($_FILES['imagenPregunta']['name'])>0){
                echo("a".$_FILES['imagenPregunta']['name']."a");
                $carpetaDestino = "img/";
                $imagenArchivo = $_FILES['imagenPregunta']['name'];
                $ruta = pathinfo($imagenArchivo);
                $nombreImagen = $ruta['filename'];
                $extension = $ruta['extension'];
                $archivoTemporal = $_FILES['imagenPregunta']['tmp_name'];
                $rutaDestino = $carpetaDestino.$nombreImagen.".".$extension;
            }
            $imagen=$rutaDestino??'img/default.png';
            
            if (!file_exists($imagen)) {
                move_uploaded_file($archivoTemporal, $imagen);
            }



            $titulo=$_POST["txtTitulo"];
            $pregunta1=$_POST["txtOpcion1"];
            $pregunta2=$_POST["txtOpcion2"];
            $pregunta3=$_POST["txtOpcion3"];
            $pregunta4=$_POST["txtOpcion4"];
            $tipo=$_POST["slcTipo"];
            $correcto=$_POST["correcto"];
            $array= array($imagen,$titulo,$pregunta1,$pregunta2,$pregunta3,$pregunta4,$tipo,$correcto);
            editarPregunta($array);
        }
    ?>
    <form action="editar.php" method="post" enctype="multipart/form-data">
    <div class="menu">
        <input type="submit" value="Guardar">
        <input type="reset" value="Limpiar">
        <a href="index.php">Volver</a>
    </div>
    <div class="contenido">
        <div class="imagen-pregunta">
            <input type="file" name="imagenPregunta"/>
        </div>
        <div class="control">
            <div class="titulo">
                <label for="txtTitulo">Pregunta:</label>
                <input type="text" id="txtTitulo" name="txtTitulo" required>
            </div>
            <div class="opciones">
                <div class="opcion">
                    <input type="radio" name="correcto" value="b1" checked>
                    <input type="text" name="txtOpcion1" required>
                </div>
                <div class="opcion">
                    <input type="radio" name="correcto" value="b2">
                    <input type="text" name="txtOpcion2" required>
                </div>
                <div class="opcion">
                    <input type="radio" name="correcto" value="b3">
                    <input type="text" name="txtOpcion3" required>
                </div>
                <div class="opcion">
                    <input type="radio" name="correcto" value="b4">
                    <input type="text" name="txtOpcion4" required>
                </div>
            </div>
            <div class="tipo">
                <label for="slcTipo">Tipo:</label>
                <select name="slcTipo" id="slcTipo">
                    <option value="ciencia">Ciencia</option>
                    <option value="arte">Arte</option>
                    <option value="deporte">Deporte</option>
                    <option value="historia">Historia</option>
                </select>
            </div>
        </div>
    </div>
    </form>
</body>

</html>