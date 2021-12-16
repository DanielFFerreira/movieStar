<?php
  include_once("templates/header.php");
?>
  <!-- main -->
  <main id="main-container">
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center vh-100">
        <div class="col-3" id="login-container">

          <h2 class="mb-4 sub-title">Cadastrar</h2>
          <form action="<?= $BASE_URL ?>cad_process.php" method="post">

            <!-- input hidden -->
            <input type="hidden" name="type" value="register">
            <!-- email -->
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <!-- nome -->
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required>
            </div>
            <!-- sobrenome -->
            <div class="form-group">
              <label for="lastname">Sobrenome</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu sobrenome" required>
            </div>
            <!-- senha -->
            <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
            </div>
            <!-- confirmar senha -->
            <div class="form-group">
              <label for="confirmpassword">Confirmação de senha:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha" required>
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