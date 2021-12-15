<?php

  $db_name = "moviestar";
  $db_host = "localhost";
  $db_user = "root";
  $db_pass = "";

  // criando a conexão - Sempre nessa ordem a direção da conexão em PDO.
  $conn = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);

  // habilitar os erros no PDO.
  // $conn->setAttribute();