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
      $user->bio = $data["bio"];
      $user->token = $data["token"];

      return $user;
    }
    public function create(User $user, $cadUser = false) {

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