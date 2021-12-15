<?php
  include_once("templates/header.php");
?>
  <!-- main -->
  <main id="main-container">
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center vh-100">
        <div class="col-3" id="login-container">
          
          <h2 class="mb-4 sub-title">Entrar</h2>
          <form action="" method="post">
            <!-- input hidden -->
            <input type="hidden" name="type" value="login">
            <!-- email -->
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <!-- senha -->
            <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
            </div>
            <!-- btn enviar -->
            <div class="form-group">
              <input type="submit" class="btn card-btn mt-4" value="Entrar">
            </div>

          </form>
        </div>
      </div>
    </div>
  </main>

<?php
  include_once("templates/footer.php");
?>

