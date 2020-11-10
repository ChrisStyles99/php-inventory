<?php

include('./classes/User.php');

$userError = '';

$errors = array('email' => '', 'password' => '');

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email)) {
    $errors['email'] = 'Email must not be empty';
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Email must be a valid email';
    }
  }

  if (empty($password)) {
    $errors['password'] = 'Password must not be empty';
  }

  if (!array_filter($errors)) {
    $user = new User();
    $loginError = $user->loginUser($email, $password);
    if($loginError) {
      $userError = $loginError;
    } else {
      header('Location: index.php');
    }
  }
}

?>

<?php 
  include('./includes/header.php');
  if(isset($_SESSION['email'])) {
    header('Location: index.php');
  }
?>
<div class="container add-product">
  <h1 class="is-size-1 has-text-centered">Login</h1>
  <p class="is-size-3 has-text-centered has-text-danger">
    <?php echo $userError ?>
  </p>
  <div class="columns is-centered">
    <form class="column is-half" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="field">
        <label for="email" class="label">Email</label>
        <div class="control has-icons-right">
          <input type="text" class="input" name="email" style="border-color: <?php echo $errors['email'] ? 'red' : '' ?>;">
          <?php if ($errors['email']) : ?>
            <span class="icon is-right">
              <i class="fas fa-times" style="color: red;"></i>
            </span>
          <?php endif; ?>
        </div>
        <div class="has-text-danger">
          <p class="is-size-5"><?php echo $errors['email'] ?></p>
        </div>
      </div>
      <div class="field">
        <label for="password" class="label">Password</label>
        <div class="control has-icons-right">
          <input type="password" class="input" name="password" style="border-color: <?php echo $errors['password'] ? 'red' : '' ?>;">
          <?php if ($errors['password']) : ?>
            <span class="icon is-right">
              <i class="fas fa-times" style="color: red;"></i>
            </span>
          <?php endif; ?>
        </div>
        <div class="has-text-danger">
          <p class="is-size-5"><?php echo $errors['password'] ?></p>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="submit" class="button is-info is-fullwidth" name="submit">
        </div>
      </div>
    </form>
  </div>
</div>
<?php include('./includes/footer.php') ?>