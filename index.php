<?php

include('./classes/Product.php');

$query = new Product();

$products = $query->getProducts();

?>

<?php
  include('./includes/header.php');
  if(!isset($_SESSION['email'])) {
    header('Location: login.php');
  }
?>

<div class="container inventory-grid">
  <h1 class="has-text-centered is-size-1">Inventory app</h1>
  <?php if (count($products) < 1) : ?>
    <p class="is-size-3 has-text-centered has-text-danger">Sorry, we have no products :(</p>
  <?php else : ?>
    <div class="columns mt-5 is-8 is-variable is-multiline">
      <?php foreach ($products as $product) : ?>
        <div class="column is-6-tablet is-4-desktop">
          <div class="card">
            <div class="card-image has-text-centered px-6">
              <img src="<?php echo htmlspecialchars($product['image_url']) ?>" alt="">
            </div>
            <div class="card-content">
              <p><?php echo htmlspecialchars($product['description']) ?></p>
              <p class="title is-size-5"><?php echo htmlspecialchars($product['name']) ?></p>
            </div>
            <footer class="card-footer">
              <p class="card-footer-item">
                <a href="single_product.php?id=<?php echo $product['id'] ?>" class="has-text-grey">View</a>
              </p>
            </footer>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php include('./includes/footer.php') ?>