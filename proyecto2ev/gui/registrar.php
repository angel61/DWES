<div class="vh-100 d-flex justify-content-center align-items-center ">
  <div class="col-10 col-md-6 col-lg-5 card">
    <div class="card-body">
      <form method="POST" action="index.php" name="frmRegistrar">
        <!--img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"-->
        <h1 class="card-title">Registrarse</h1>
        <div class="row">
          <div class="col-md-6">
            <label for="inputNombre" class="card-text">Nombre</label>
            <input type="text" id="inputNombre" name="registrarNombre" class="form-control mb-3" placeholder="Nombre" required autofocus>
          </div>
          <div class="col-md-6">
            <label for="inputApellidos" class="card-text">Apellidos</label>
            <input type="text" id="inputApellidos" name="registrarApellidos" class="form-control mb-3" placeholder="Apellidos" required autofocus>

          </div>
          <div class="col-md-6">
            <label for="inputEmail" class="card-text">Dirección de correo</label>
            <input type="email" id="inputEmail" name="registrarEmail" class="form-control mb-3" placeholder="Dirección de correo" required autofocus>

          </div>
          <div class="col-md-6">
            <label for="inputPassword" class="card-text">Contraseña</label>
            <input type="password" id="inputPassword" name="registrarPass" class="form-control mb-3" placeholder="Contraseña" required>
          </div>
        </div>
        <?php $this->prinErrorRegistrar(); ?>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button>
    </div>
    </form>
  </div>
</div>