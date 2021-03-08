<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/listado.css">
    <title>Tienda guadalajara</title>
</head>

<body class="vh-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Tienda Guadalajara</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContenido">
                <form method="POST" action="index.php" class="form-inline my-3 my-md-2 mx-lg-4 col-md-8 d-flex justify-content-center">
                    <div class="input-group w-100">
                        <input class="form-control" type="text" placeholder="Buscar" name="inpBusqueda">
                        <button style="border-radius: 0px 5px 5px 0px;" class="btn btn-light">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav ml-3 mr-auto">
                    <?php $this->printSesion();?>
                </ul>
            </div>
        </nav>
    </header>