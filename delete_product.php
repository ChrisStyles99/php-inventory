<?php 

include('./classes/Product.php');
include('./includes/header.php');

if(!isset($_SESSION['email'])) {
  header('Location: login.php');
}  

if(isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = new Product();
  $query->deleteProduct($id);

  header('Location: index.php');
}