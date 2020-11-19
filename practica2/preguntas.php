<!DOCTYPE html>
<html lang="es">
<?php session_start();?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <?php
    if (isset($_POST['txtUsuario'])&&strlen($_POST['txtUsuario'])>0) {
        $_SESSION['usuario']=$_POST['txtUsuario'];
    }
        if (isset($_SESSION['usuario'])) {
            ?>
    <form action="comprobar_pregunta.php" method="post">
        <input type="hidden" name="hdnPregunta" value="<?php echo $_SESSION["cont"]; ?>">
        <div class="menu">
            <?php echo "Arte: ".$_SESSION['puntuacion']['arte'].
            " - Ciencia: ".$_SESSION['puntuacion']['ciencia'].
            " - Historia: ".$_SESSION['puntuacion']['historia'].
            " - Deporte: ".$_SESSION['puntuacion']['deporte']; ?>
        </div>
        <div class="contenido">
            <div class="imagen-pregunta">
                <img src="<?php echo $_SESSION['pregunta'][0]; ?>">
            </div>
            <div class="control">
                <div class="titulo">
                    <h2>
                        <?php
                            echo  $_SESSION['pregunta'][1]; ?>
                    </h2>
                </div>
                <div class="opciones">
                    <div class="opcion">
                        <button name="btn" value="b1">
                            <?php
                                echo $_SESSION['pregunta'][2]; ?>
                        </button>
                    </div>
                    <div class="opcion">
                        <button name="btn" value="b2">
                            <?php
                                echo $_SESSION['pregunta'][3]; ?>
                        </button>
                    </div>
                    <div class="opcion">
                        <button name="btn" value="b3">
                            <?php
                                echo $_SESSION['pregunta'][4]; ?>
                        </button>
                    </div>
                    <div class="opcion">
                        <button name="btn" value="b4">
                            <?php
                                echo $_SESSION['pregunta'][5]; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
            
    <div class="tipoPregunta">
        <p><?php
                    echo ucfirst($_SESSION['pregunta'][6]); 
                ?></p>
    </div>
    <?php
        } else {
    ?>
    <div class="empezar-usuario">
        <form action="preguntas.php" method="post" class="formEmpezar">
            <div class="opcion">
                <label for="txtUsuario">Usuario:</label>
                <input type="text" name="txtUsuario" required>
            </div>
            <input type="submit" name="¡Empezar!" class="opcion-empezar">
        </form>
    </div>

    <?php
        }
    ?>
</body>

</html>