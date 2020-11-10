<?php 

  session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</head>

<body>
  <nav class="navbar has-shadow is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item is-size-3 has-text-white" href="index.php">
        Inventory app
      </a>
      <a role="button" class="navbar-burger burger" id="burger">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="nav-links" class="navbar-menu">
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <?php if (isset($_SESSION['email'])) :  ?>
              <a class="button is-info" href="add_product.php">
                Add product
              </a>
              <a class="button is-danger" href="logout.php">
                Logout
              </a>
            <?php else : ?>
              <a href="login.php" class="button is-warning">Login</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </nav>