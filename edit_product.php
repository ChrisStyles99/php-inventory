<?php

include('./classes/Product.php');

$errors = array('name'=>'', 'description'=>'', 'quantity'=>'', 'image_url'=>'', 'category'=>'');

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = new Product();
  $product = $query->getSingleProduct($id);

  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = intval($_POST['quantity']);
    $image_url = $_POST['image_url'];
    $category = $_POST['category'];

    if(empty($name)) {
      $errors['name'] = 'The name must not be empty';
    } else {
      if(!preg_match('/[a-zA-z\s]+$/', $name)) {
        $errors['name'] = 'The name must be letters and spaces only';
      }
    }

    if(empty($description)) {
      $errors['description'] = 'The description must not be empty';
    }

    if(empty($quantity)) {
      $errors['quantity'] = 'The quantity must not be empty';
    }

    if(empty($image_url)) {
      $errors['image_url'] = 'The image URL should not be empty';
    } else {
      if(!filter_var($image_url, FILTER_VALIDATE_URL)) {
        $errors['image_url'] = 'The image URL must be a valid URL';
      }
    }

    if(empty($category)) {
      $errors['category'] = 'Category should not be empty';
    }

    if(!array_filter($errors)) {
      $query->editProduct($name, $description, $quantity, $image_url, $category, $id);

      header("Location: single_product.php?id=$id");
    }
  }
}

?>

<?php 
  include('./includes/header.php');
  if(!isset($_SESSION['email'])) {
    header('Location: login.php');
  }  
?>
<div class="container edit-product">
  <h1 class="is-size-1 has-text-centered">Edit product</h1>
  <div class="columns is-centered">
    <form action="edit_product.php?id=<?php echo $id ?>" method="POST" class="product-form column is-half">
      <div class="field">
        <label for="name" class="label">Product name</label>
        <div class="control has-icons-right">
          <input style="border-color: <?php echo $errors['name'] ? 'red' : '' ?>;" type="text" name="name" id="name" class="input" value="<?php echo htmlspecialchars($product['name']) ?>">
          <?php if ($errors['name']) : ?>
            <span class="icon is-right">
              <i class="fas fa-times" style="color: red;"></i>
            </span>
          <?php endif; ?>
        </div>
        <div class="has-text-danger">
          <p class="is-size-5"><?php echo $errors['name'] ?></p>
        </div>
      </div>
      <div class="field">
        <label for="description" class="label">Product description</label>
        <div class="control has-icons-right">
          <input style="border-color: <?php echo $errors['description'] ? 'red' : '' ?>;" type="text" name="description" id="description" class="input" value="<?php echo htmlspecialchars($product['description']) ?>">
          <?php if ($errors['description']) : ?>
            <span class="icon is-right">
              <i class="fas fa-times" style="color: red;"></i>
            </span>
          <?php endif; ?>
        </div>
        <div class="has-text-danger">
          <p class="is-size-5"><?php echo $errors['description'] ?></p>
        </div>
      </div>
      <div class="field">
        <label for="quantity" class="label">Product quantity</label>
        <div class="control has-icons-right">
          <input style="border-color: <?php echo $errors['quantity'] ? 'red' : '' ?>;" type="number" name="quantity" id="quantity" class="input" value="<?php echo htmlspecialchars($product['quantity']) ?>">
          <?php if ($errors['quantity']) : ?>
            <span class="icon is-right">
              <i class="fas fa-times" style="color: red;"></i>
            </span>
          <?php endif; ?>
        </div>
        <div class="has-text-danger">
          <p class="is-size-5"><?php echo $errors['quantity'] ?></p>
        </div>
      </div>
      <div class="field">
        <label for="image_url" class="label">Product image URL</label>
        <div class="control has-icons-right">
          <input style="border-color: <?php echo $errors['image_url'] ? 'red' : '' ?>;" type="text" name="image_url" id="image_url" class="input" value="<?php echo htmlspecialchars($product['image_url']) ?>">
          <?php if ($errors['image_url']) : ?>
            <span class="icon is-right">
              <i class="fas fa-times" style="color: red;"></i>
            </span>
          <?php endif; ?>
        </div>
        <div class="has-text-danger">
          <p class="is-size-5"><?php echo $errors['image_url'] ?></p>
        </div>
      </div>
      <div class="field">
        <div class="select">
          <select name="category" style="border-color: <?php echo $errors['category'] ? 'red' : '' ?>;">
            <option value="">Select category</option>
            <option value="vegetables" <?php if ($product['category'] == 'vegetables') echo 'selected="selected"' ?>>Vegetables</option>
            <option value="fruits" <?php if ($product['category'] == 'fruits') echo 'selected="selected"' ?>>Fruits</option>
          </select>
        </div>
        <div class="has-text-danger">
          <p class="is-size-5"><?php echo $errors['category'] ?></p>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="submit" class="button is-info" name="submit" value="Update product">
        </div>
      </div>
    </form>
  </div>
</div>
<?php include('./includes/footer.php') ?>