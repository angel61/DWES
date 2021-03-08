<div class="mh-75 my-3 my-md-0 d-flex justify-content-center align-items-center ">
  <div class="col-10 col-md-6 col-lg-5 card">
    <div class="card-body">
      <form method="POST" action="index.php" name="frmAddDireccion">
        <h1 class="card-title">Nueva dirección</h1>
        <div class="row">
          <div class="col-md-6">
            <label for="inputPais" class="card-text">Pais</label>
            <input type="text" id="inputPais" name="inputPais" class="form-control mb-3" placeholder="Pais" required autofocus>
          </div>
          <div class="col-md-6">
            <label for="inputProvincia" class="card-text">Provincia</label>
            <input type="text" id="inputProvincia" name="inputProvincia" class="form-control mb-3" placeholder="Provincia" required autofocus>

          </div>
          <div class="col-md-6">
            <label for="inputCiudad" class="card-text">Ciudad</label>
            <input type="text" id="inputCiudad" name="inputCiudad" class="form-control mb-3" placeholder="Ciudad" required autofocus>

          </div>
          <div class="col-md-6">
            <label for="inputCalle" class="card-text">Calle</label>
            <input type="text" id="inputCalle" name="inputCalle" class="form-control mb-3" placeholder="Calle" required>
          </div>
          <div class="col-md-6">
            <label for="inputNumero" class="card-text">Numero</label>
            <input type="number" id="inputNumero" name="inputNumero" class="form-control mb-3" placeholder="Numero" required>
          </div>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Añadir</button>
    </div>
    </form>
  </div>
</div>