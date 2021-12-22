<?php

  require_once("templates/header.php");

  if($userDao) {
    // destroir o token
    $userDao->destroyToken();
  }