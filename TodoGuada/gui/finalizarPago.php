  <form action="index.php" method="post">
    <div class="mt-5 d-flex flex-column justify-content-center gap-3 align-items-center ">
      <div class="col-12 col-md-6 card my-md-2">
        <div class="card-body">
          <h1 class="card-title h3">Direcciones de envio</h1>
          <select class="form-control" name="slcDireccion" id="slcDireccion">
            <?php $this->printDireccionEnvio(); ?>
          </select>
        </div>
      </div>
      <div class="col-12 col-md-6 card my-md-2">
        <div class="card-body">
          <h1 class="card-title h3">Métodos de pago</h1>
          <select class="form-control" name="slcPago" id="slcPago">
            <?php $this->printMetodoPago(); ?>
          </select>
        </div>
      </div>
      <div class="col-12 col-md-6 card my-md-2">
        <div class="card-body">
          <?php $this->printFinalizarPago();?>
        </div>
      </div>
    </div>
  </form>