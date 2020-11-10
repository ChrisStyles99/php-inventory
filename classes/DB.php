<?php

  include('.env.php');

  class DB {
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'wicho1';
    private $dbName = 'php_inventory';
    private $port = 3307;

    protected function connect() {
      $dsn = "mysql:host=". $_ENV['DB_HOST'] .";dbname=". $_ENV['DB_NAME'] .";port=" . $_ENV['DB_PORT'];
      $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
    }
  }
