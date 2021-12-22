<?php
  // importando
  require_once("models/User.php");

  class UserDAO implements UserDAOInterface {

    // chamar conexão e url
    private $conn;
    private $url;

    // iniciando o construtor
    public function __construct(PDO $conn, $url)
    {
      // aqui estou dando um nome e chamando a conexão e url
      $this->conn = $conn;
      $this->url = $url;
    }

    public function buildUser($data) {
      // instanciando (User)
      $user = new User();

      $user->id = $data["id"];
      $user->name = $data["name"];
      $user->lastname = $data["lastname"];
      $user->email = $data["email"];
      $user->password = $data["password"];
      $user->image = $data["image"];
      $user->biografy = $data["biografy"];
      $user->token = $data["token"];

      return $user;
    }
    public function create(User $user, $cadUser = false) {

      $stmt = $this->conn->prepare("INSERT INTO users(
        name, lastname, email, password, token
      ) VALUES (
        :name, :lastname, :email, :password, :token
      )");

      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":lastname", $user->lastname);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":token", $user->token);

      $stmt->execute();

      // autenticar usuário, caso o método auth seja true
      // if($authUser) {
      //   $this->setTokenToSession($user->token);
      // }
    }
    public function update(User $user, $redirect = true) {

    }
    public function verifyToken($protected = false) {

    }
    public function setTokenToSession($token, $redirect = true) {

    }
    public function authenticateUser($email, $password) {

    }
    public function findByEmail($email) {
      // verificar se o email é diferente de vázio
      if($email != "") {

        // buscar no banco a tabela (users).
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam("email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);

          return $user;

        }else {
          return false;
        }

      }else {
        return false;
      }
    }
    public function findById($id) {

    }
    public function findByToken($token) {

    }
    public function destroyToken() {

    }
    public function changePassword(User $user) {

    }
  }