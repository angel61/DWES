<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Tienda guadalajara</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark d-flex justify-content-center">
            <a class="navbar-brand" href="index.php">Expand at md</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarsExample04">
                <form method="POST" action="index.php" class="form-inline my-5 my-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Buscar">
                        <button style="border-radius: 0px 5px 5px 0px;" class="btn btn-light">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['usuarioDatos']["nombre"]??"Usuario";?></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="?paso=info">Información personal</a>
                            <a class="dropdown-item" href="?cerrarSesion=true">Cerrar sesión</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <body>