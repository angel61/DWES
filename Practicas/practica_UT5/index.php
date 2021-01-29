<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
</head>

<body>
    <form action="Cliente_Solicitud_Token.php" method="post">
        <fieldset>
            <legend>Solicitar token</legend>
            <div>Usuario: <input type="text" name="usuario"></div>
            <div>Contraseña: <input type="password" name="pass"></div>
            <button>Solicitar</button>
        </fieldset>
    </form>
    <form action="Cliente_Servicios.php" method="get">
        <fieldset>
            <legend>Acceso a servicios (Token necesario)</legend>
            <div>Token: <input type="text" name="token"></div>
            <button>Acceder</button>
        </fieldset>
    </form>
</body>

</html>