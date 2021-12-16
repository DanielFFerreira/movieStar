<?php

  // classe usuário 
  class User {
    // public campos do banco
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $image;
    public $token;
    public $biography;
  }

  interface UserDAOInterface {
    // método do DAO
    public function buildUser($data);
    public function create(User $user, $cadUser = false);
    public function update(User $user, $redirect = true);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $password);
    public function findByEmail($email);
    public function findById($id);
    public function findByToken($token);
    public function destroyToken();
    public function changePassword(User $user);
  }