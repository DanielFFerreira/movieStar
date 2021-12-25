<?php
  // importando
  require_once("models/User.php");
  require_once("models/Message.php");

  class UserDao implements UserDAOInterface {

    // chamar conexão e url
    private $conn;
    private $url;
    private $message;

    // iniciando o construtor
    public function __construct(PDO $conn, $url)
    {
      // aqui estou dando um nome e chamando a conexão e url
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
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
      $user->biography = $data["biography"];
      $user->token = $data["token"];

      return $user;
    }
    public function create(User $user, $authUser = false) {

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

      // executar
      $stmt->execute();

      // autenticar usuário, caso o método auth seja true
      if($authUser) {
        $this->setTokenToSession($user->token);
      }
    }
    public function update(User $user, $redirect = true) {

      $stmt = $this->conn->prepare("UPDATE users SET
        name = :name,
        lastname = :lastname,
        email = :email,
        image = :image,
        biography = :biography,
        token = :token
        WHERE id = :id
      ");

      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":lastname", $user->lastname);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":image", $user->image);
      $stmt->bindParam(":biography", $user->biography);
      $stmt->bindParam(":token", $user->token);
      $stmt->bindParam(":id", $user->id);

      $stmt->execute();

      if($redirect) {
        // redireciona para o perfil do usuário.
        $this->message->setMessage("Dados atualizados com sucesso!", "success", "editprofile.php");
      }

    }
    public function verifyToken($protected = false) {
      // verificar se a sessão do token está vazio.
      if(!empty($_SESSION["token"])) {
        // pegar o token que está na sessão
        $token = $_SESSION["token"];

        $user = $this->findByToken($token);

        if($user) {
          return $user;
        }else if($protected) {
          // redireciona usuário não autenticado.
          $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
        }

      }else if($protected) {
        // redireciona usuário não autenticado.
        $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
      }
    }
    public function setTokenToSession($token, $redirect = true) {
      // salvar token na session(sessão).
      $_SESSION["token"] = $token;

      if($redirect) {
        // redireciona para o perfil do usuário.
        $this->message->setMessage("Seja bem-vindo!", "success", "editprofile.php");
      }

    }
    public function authenticateUser($email, $password) {
      $user = $this->findByEmail($email);

      if($user) {
        // checar se as senhas batem
        if(password_verify($password, $user->password)) {
          // gerar um token e inserir na sessão.
          $token = $user->generateToken();

          $this->setTokenToSession($token, false);

          // atualizar token no usuário.
          $user->token = $token;

          $this->update($user, false);

          return true;

        }else {
          return false;
        }
        
      }else {
        return false;
      }

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
      // verificar se o email é diferente de vázio
      if($token != "") {

        // buscar no banco a tabela (users).
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
        $stmt->bindParam("token", $token);
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
    public function destroyToken() {
      // remover o toen da sessão(session).
      $_SESSION["token"] = "";

      // redirecionar e apresentar a mensagem de sucesso.
      $this->message->setMessage("Você fez o logout com sucesso!", "success", "index.php");
    }
    public function changePassword(User $user) {

    }
  }