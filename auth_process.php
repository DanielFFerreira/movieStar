<?php

  // inserindo uma vez o arquivo globals
  require_once("config/globals.php");
  // inserir o arquivo de conexão com o banco de dados
  require_once("database/db.php");
  // logar usuarios
  require_once("models/User.php");
  require_once("config/dao/UserDAO.php");

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

    }else {
      // enviar uma msg de erro, dos dados faltantes
      
    }

  }else if($type === "login") {

  }
  