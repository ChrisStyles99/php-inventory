<?php 

  include('DB.php');

  class Product extends DB {
    public function getProducts() {
      $sql = 'SELECT * FROM products';
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    }

    public function getSingleProduct($id) {
      $sql = 'SELECT * FROM products WHERE id = ?';
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array($id));
      return $stmt->fetch();
    }

    public function addProduct($name, $description, $quantity, $image_url, $category) {
      $sql = 'INSERT INTO products (name, description, quantity, image_url, category) VALUES (?, ?, ?, ?, ?)';
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array($name, $description, $quantity, $image_url, $category));
    }

    public function editProduct($name, $description, $quantity, $image_url, $category, $id) {
      $sql = 'UPDATE products SET name = ?, description = ?, quantity = ?, image_url = ?, category = ? WHERE id = ?';
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array($name, $description, $quantity, $image_url, $category, $id));
    }

    public function deleteProduct($id) {
      $sql = 'DELETE FROM products WHERE id = ?';
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array($id));
    }
  }