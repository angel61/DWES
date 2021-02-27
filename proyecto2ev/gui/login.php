  <div class="vh-100 d-flex justify-content-center align-items-center ">
    <div class="col-10 col-md-6 col-lg-3 card">
      <div class="card-body">
        <form method="POST" action="index.php" name="frmLogin">
          <!--img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"-->
          <h1 class="card-title">Iniciar sesión</h1>
          <label for="inputEmail" class="card-text">Dirección de correo</label>
          <input type="email" id="inputEmail" name="loginEmail" class="form-control mb-3" placeholder="Dirección de correo" required autofocus>
          <label for="inputPassword" class="card-text">Contraseña</label>
          <input type="password" id="inputPassword" name="loginPass" class="form-control mb-3" placeholder="Contraseña" required>
          <?php $this->printErrorLogin(); ?>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Enviar</button>
      </div>
      </form>
    </div>
  </div>