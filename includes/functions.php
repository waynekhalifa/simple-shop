<?php

// You can not access this file directly
if (!defined('included')) {
  die('You cannot access this file directly!');
}

function register($conn, $name, $email, $pass)
{
  //strip all tags from varible
  $name = strip_tags(mysqli_real_escape_string($conn, $name));
  $email = strip_tags(mysqli_real_escape_string($conn, $email));
  $pass = strip_tags(mysqli_real_escape_string($conn, $pass));

  // hash password
  $pass = md5($pass);

  // create new user
  $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass')";
  mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));

  $_SESSION['success'] = 'Your account has been created successfully';
  header('Location: ' . DIR . 'login.php');
  exit();
}

//log user in ---------------------------------------------------
function login($conn, $email, $pass)
{

  //strip all tags from varible
  $email = strip_tags(mysqli_real_escape_string($conn, $email));
  $pass = strip_tags(mysqli_real_escape_string($conn, $pass));

  // hash password
  $pass = md5($pass);

  // check if the email id and password combination exist in database
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
  $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));


  if (mysqli_num_rows($result) == 1) {
    // the email and password match,
    // get auth user
    $auth_user = mysqli_fetch_object($result);

    // set the session
    $_SESSION['authentication'] = true;
    $_SESSION['auth_user'] = array(
      'id' => $auth_user->id,
      'name' => $auth_user->name,
      'email' => $auth_user->email
    );

    if ($auth_user->admin == 1) {
      // set admin session
      $_SESSION['admin'] = true;
      // direct to admin
      header('Location: ' . DIRADMIN);
    } else {
      // direct to user account
      header('Location: ' . DIR . 'my-account.php');
    }
    exit();
  } else {
    // define an error message
    $_SESSION['error'] = 'Sorry, wrong username or password';
  }
}

// Authentication
function logged_in()
{
  if (isset($_SESSION['authentication']) && $_SESSION['authentication'] === true) {
    return true;
  } else {
    return false;
  }
}


function login_required()
{
  if (logged_in()) {
    return true;
  } else {
    header('Location: ' . DIR . 'login.php');
    exit();
  }
}

// admin authorization
function admin()
{
  if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    return true;
  } else {
    return false;
  }
}

function admin_required()
{
  if (admin()) {
    return true;
  } else {
    $_SESSION['error'] = "You don't have administration permission";
    header('Location: ' . DIR . 'login.php');
    exit();
  }
}

// logout
function logout()
{
  unset($_SESSION['authentication']);
  unset($_SESSION['auth_user']);
  unset($_SESSION['admin']);
  unset($_SESSION['error']);
  unset($_SESSION['purchase']);
  header('Location: ' . DIR . 'login.php');
  exit();
}

// Render error messages
function messages()
{
  $message = '';
  if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
    $message = '<div class="msg-ok">' . $_SESSION['success'] . '</div>';
    $_SESSION['success'] = '';
  }

  if (isset($_SESSION['purchase']) && $_SESSION['purchase'] != '') {
    $message = '<div class="msg-purchase">' . $_SESSION['auth_user']['name'] . ', ' . $_SESSION['purchase'] . '</div>';
    $_SESSION['success'] = '';
  }

  if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
    $message = '<div class="msg-error">' . $_SESSION['error'] . '</div>';
    $_SESSION['error'] = '';
  }
  echo "$message";
}

function errors($error)
{
  if (!empty($error)) {
    $i = 0;
    $showError = "";
    while ($i < count($error)) {
      $showError .= "<div class=\"msg-error\">" . $error[$i] . "</div>";
      $i++;
    }
    echo $showError;
  }
}

function purchase($conn, $user_id, $product_id)
{
  //strip all tags from varible
  $user_id = intval(strip_tags(mysqli_real_escape_string($conn, $user_id)));
  $product_id = intval(strip_tags(mysqli_real_escape_string($conn, $product_id)));

  // palce order
  $sql = "INSERT INTO orders (user_id, product_id) VALUES ('$user_id', '$product_id')";
  mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));

  $_SESSION['success'] = 'thank you for your purchase';
  header('Location: ' . DIR . 'my-account.php');
  exit();
}

function review_product($conn, $user_id, $product_id, $comment)
{
  //strip all tags from varible
  $user_id = intval(strip_tags(mysqli_real_escape_string($conn, $user_id)));
  $product_id = intval(strip_tags(mysqli_real_escape_string($conn, $product_id)));
  $comment = strip_tags(mysqli_real_escape_string($conn, $comment));

  // review product
  $sql = "INSERT INTO reviews (user_id, product_id, comment) VALUES ('$user_id', '$product_id', '$comment')";
  mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));

  $_SESSION['success'] = 'thank you for your feedback';
}

function create_product($conn, $name, $description, $price, $image)
{
  $name = strip_tags(mysqli_real_escape_string($conn, $name));
  $description = strip_tags(mysqli_real_escape_string($conn, $description));
  $price = strip_tags(mysqli_real_escape_string($conn, $price));
  $image = strip_tags(mysqli_real_escape_string($conn, $image));

  // review product
  $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
  mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));

  $_SESSION['success'] = 'Product has been added succesfully';
  header('Location: ' . DIRADMIN . 'products.php');
  exit();
}

function edit_product($conn, $id, $name, $description, $price, $image)
{
  //strip all tags from varible
  $id = intval(strip_tags(mysqli_real_escape_string($conn, $id)));
  $name = strip_tags(mysqli_real_escape_string($conn, $name));
  $description = strip_tags(mysqli_real_escape_string($conn, $description));
  $price = strip_tags(mysqli_real_escape_string($conn, $price));
  $image = strip_tags(mysqli_real_escape_string($conn, $image));

  $sql = "UPDATE products
          SET name = '$name', description = '$description', price = '$price', image = '$image'
          WHERE id = '$id'";
  mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));

  $_SESSION['success'] = 'Product have been updated successfully';
  header('Location: ' . DIRADMIN . 'products.php');
  exit();
}

function delete_product($conn, $id)
{
  //strip all tags from varible
  $id = intval(strip_tags(mysqli_real_escape_string($conn, $id)));

  $sql = "DELETE FROM products WHERE id = '$id'";
  mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));

  $_SESSION['success'] = 'Product have been deleted successfully';
  header('Location: ' . DIRADMIN . 'products.php');
  exit();
}
