<?php 

include('./classes/User.php');

$newUser = new User();

$error = $newUser->registerUser('Christian', 'chris@mail.com', '123456');

if($error) {
  echo $error;
} else {
  header('Location: index.php');
}