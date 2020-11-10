<?php

  include('DB.php');

  class User extends DB {
    public function registerUser($name, $email, $password) {
      $sql = 'SELECT * FROM users WHERE email = ?';
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array($email));
      $emailExists = $stmt->fetch();
      if($emailExists > 0) {
        return "Email already exists";
      } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $newUser = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';
        $statement = $this->connect()->prepare($newUser);
        $statement->execute(array($name, $email, $hashedPassword));
        return;
      }
    }

    public function loginUser($email, $password) {
      $sql = 'SELECT * FROM users WHERE email = ?';
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array($email));
      $emailExists = $stmt->fetch();
      if($emailExists < 1) {
        return "Email doesn't exists";
      } else {
        $validPassword = password_verify($password, $emailExists['password']);
        if(!$validPassword) {
          return "Passwords doesn't match";
        } else {
          session_start();
          $_SESSION['email'] = $emailExists['email'];
          return;
        }
      }
    }
  }