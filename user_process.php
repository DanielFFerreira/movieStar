<?php

  // inserindo uma vez o arquivo globals
  require_once("config/globals.php");
  // inserir o arquivo de conexão com o banco de dados
  require_once("database/db.php");
  // logar usuarios
  require_once("models/User.php");
  require_once("models/Message.php");
  require_once("config/dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $userDao = new UserDAO($conn, $BASE_URL);

  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  if($type === "update") {

    // resgata dados do usuário do token
    $userData = $userDao->verifyToken();

    // receber dados do post
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $biografy = filter_input(INPUT_POST, "biografy");

    // Criar um novo objeto de usuário
    $user = new User();

    // Preencher os dados do usuário
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->biografy = $biografy;

    // upload de imagem
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
      
      $image = $_FILES["image"];
      $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
      $jpgArray = ["imagejpeg", "image/jpg"];

      // checar o tipo da imagem
      if(in_array($image["type"], $imageTypes)) {

        // checar se é jpg.
        if(in_array($image, $jpgArray)) {

          // cria uma nova imagem a a partir de um arquivo ou URL
          $imageFile = imagecreatefromjpeg($image["tmp_name"]);

        }else {

          $imageFile = imagecreatefrompng($image["tmp_name"]);
        }

        $imageName = $user->imageGenerateName();

      }else {
        $message->setMessage("Tipo inválido de imagem, insira png ou jpg", "error", "back");
      }

    }

    $userDao->update($userData);

  }else if($type === "changepassword") {

  }else {
    $message->setMessage("Informações inválidas.", "error", "index.php");
  }