<div class="vh-100 d-flex justify-content-center align-items-center ">
  <div class="col-10 col-md-6 col-lg-5 card">
    <div class="card-body">
      <form method="POST" action="index.php" name="frmAddDireccion">
        <h1 class="card-title">Nuevo método de pago</h1>
        <div class="row">
          <div class="col-md-6">
            <label for="inputTitular" class="card-text">Titular</label>
            <input type="text" id="inputTitular" name="inputTitular" class="form-control mb-3" placeholder="Titular" required autofocus>
          </div>
          <div class="col-md-6">
            <label for="inputNumero" class="card-text">Número</label>
            <input type="number" id="inputNumero" name="inputNumero" class="form-control mb-3" placeholder="Número" required autofocus>

          </div>
          <div class="col-md-6">
            <label for="inputCaducidad" class="card-text">Caducidad</label>
            <input type="text" id="inputCaducidad" name="inputCaducidad" class="form-control mb-3" placeholder="Caducidad" required autofocus>

          </div>
          <div class="col-md-6">
            <label for="inputNumeroSecreto" class="card-text">Número secreto</label>
            <input type="text" id="inputNumeroSecreto" name="inputNumeroSecreto" class="form-control mb-3" placeholder="Número secreto" required>
          </div>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Añadir</button>
    </div>
    </form>
  </div>
</div>