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

  // resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // verificação do tipo de formulário
  if($type === "register") { 

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // verificação(validar) de dados mínimos
    if($name && $lastname && $email && $password) {
      // verificar se as senhas batem
      if($password === $confirmpassword) {
        // verificar se o e-mail já está cadastrado no sistema
        if($userDao->findByEmail($email) === false) {
          // mensagem (nenhum usuário foi encontrado)
          echo "Nenhum usuário foi encontrado!";
        }else {
          // enviar uma msg de erro, usuário já existe
          $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "back");
        }

      }else {
        // enviar uma msg de erro, senhas não conferem
        $message->setMessage("Senhas não são iguais.", "error", "back");
      }

    }else {
      // enviar uma msg de erro, dos dados faltantes
      $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
    }

    // validando senha permitindo caracteres, números e letras
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
      $message->setMessage(
        "
        A senha não atende aos requisitos!
        No mínimo têm que conter letras e números.
        Deve conter pelo menos 1 número e 1 letra Maiúscula.
        Pode conter qualquer um desses caracteres: !@#$%.
        Deve ter de 8 até 12 caracteres.
        ", "error", "back"
      );
    }

     // verificar o tamanho da senha
    // if(strlen($password >= 12)) {
    //   $message->setMessage("A senha ultrapassou o tamanho máximo permitido.", "error", "back");
    // }

    // if(strlen($password < 1)) {
    //   $message->setMessage("Informe a senha.", "error", "back");
    // }else if(!preg_match('/^[0-9a-z]{8,12}$/i', $password)) {
    //   $message->setMessage("Senha inválida.", "error", "back");
    // }
    /* 
      Pode conter letras e números
      Deve conter pelo menos 1 número e 1 letra
      Pode conter qualquer um desses caracteres: !@#$%
      Deve ter 8-12 caracteres
    */

  }else if($type === "login") {

  }
  