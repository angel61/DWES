  <div class="mt-5 d-flex flex-column justify-content-center gap-3 align-items-center ">
    <div class="h2 mb-4">Información personal</div>
    <div class="col-12 col-md-6 card my-md-2">
      <div class="card-body">
        <h1 class="card-title h3">Información básica</h1>
        <?php $this->printInfoPersonal(); ?>
      </div>
    </div>
    <div class="col-12 col-md-6 card my-md-2">
      <div class="card-body">
        <h1 class="card-title h3">Direcciones de envio</h1>
        <form action="index.php" method="post">
          <select  class="form-control" name="slcDireccion" id="slcDireccion">
            <?php $this->printDireccionEnvio(); ?>
          </select>
          <div class="d-flex py-3">
            <a href="index.php?paso=anadirDireccion" class="mx-2 btn btn-outline-success" name="paso" value="addDireccion">Añadir</a>
            <button class="mx-2 btn btn-outline-danger" name="deleteDireccion">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-12 col-md-6 card my-md-2">
      <div class="card-body">
        <h1 class="card-title h3">Métodos de pago</h1>
        <form action="index.php" method="post">
          <select class="form-control" name="slcPago" id="slcPago">
            <?php $this->printMetodoPago(); ?>
          </select>
          <div class="d-flex py-3">
            <a href="index.php?paso=anadirPago" class="mx-2 btn btn-outline-success" name="paso" value="addPago">Añadir</a>
            <button class="mx-2 btn btn-outline-danger" name="deletePago">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>