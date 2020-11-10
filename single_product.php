<?php 

  include('./classes/Product.php');

  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = new Product();
    $product = $query->getSingleProduct($id);
  } else {
    header('Location: index.php');
  }

?>

<?php 
  include('./includes/header.php');
  if(!isset($_SESSION['email'])) {
    header('Location: login.php');
  }  
?>
  <div class="container single-product">
    <h1 class="is-size-1 has-text-centered">Product <?php echo $product['id'] ?></h1>
    <div class="columns">
      <div class="column is-4-tablet">
        <img src="<?php echo htmlspecialchars($product['image_url']) ?>" alt="">
      </div>
      <div class="column is-8-tablet has-text-centered is-align-content-center">
        <h1 class="is-size-3"><?php echo htmlspecialchars($product['name']) ?></h1>
        <p><?php echo htmlspecialchars($product['description']) ?></p>
        <p>Quantity: <?php echo htmlspecialchars($product['quantity']) ?></p>
        <p>Category: <?php echo htmlspecialchars($product['category']) ?></p>
        <div class="buttons is-justify-content-center">
          <a href="edit_product.php?id=<?php echo $id ?>" class="button is-info">Edit Product</a>
          <a href="delete_product.php?id=<?php echo $id ?>" class="button is-danger">Delete Product</a>
        </div>
      </div>
    </div>
  </div>
<?php include('./includes/footer.php') ?>