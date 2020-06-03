<?php
// include config to connect to data and use our functions
require '../includes/config.php';

//make sure user is logged in, function will redirect user if not logged in
admin_required();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Shop</title>
</head>

<body>

  <header>
    <div>
      <a href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
    </div>
    <ul>
      <li><a href="<?php echo DIR . '?logout'; ?>">logout</a></li>
      <li><a href="<?php echo DIR; ?>">visit site</a></li>
    </ul>
  </header>
  <main>
    <ul>
      <li><a href="<?php echo DIRADMIN . 'products.php'; ?>">all products</a></li>
      <li><a href="<?php echo DIRADMIN . 'new-product.php'; ?>">new products</a></li>
      <li><a href="<?php echo DIRADMIN . 'edit-product.php'; ?>">edit products</a></li>
      <li><a href="<?php echo DIRADMIN . 'orders.php'; ?>">all orders</a></li>
      <li><a href="<?php echo DIRADMIN . 'reviews.php'; ?>">all reviews</a></li>
    </ul>
    <h1>Hi <?php echo $_SESSION['auth_user']['name'] ?></h1>
  </main>
  <footer>footer</footer>
</body>

</html>