<?php
  require_once("templates/header.php");

  require_once("config/dao/UserDAO.php");

  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);
?>
  <!-- main -->
  <main id="main-container" class="container-fluid">
    <h1>Edição de Perfil</h1>
  </main>

<?php
  require_once("templates/footer.php");
?>

