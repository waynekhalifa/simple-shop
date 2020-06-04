<?php
// include config to connect to data and use our functions
require 'includes/config.php';

//make sure user is logged in, function will redirect user if not logged in
login_required();

if (isset($_GET['product'])) {
  $product_id = $_GET['product'];
  $user_id = $_SESSION['auth_user']['id'];
  purchase($conn, $user_id, $product_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo DIR . 'assets/css/styles.css'; ?>" type="text/css">
  <!-- google font -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <title>My Account | <?php echo SITETITLE; ?></title>
</head>

<body>
  <div class="header-wrapper">
    <div class="container">
      <header class="site-header">
        <a class="logo" href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
        <ul class="navigation">
          <li><a href="<?php echo DIR . '?logout'; ?>">logout</a></li>
        </ul>
      </header>
    </div>
  </div>
  <main class="container">
    <?php messages() ?>
    <h1 class="page-title">Hi <?php echo $_SESSION['auth_user']['name'] ?> welcome back</h1>
    <h2 class="section-title">Your orders history</h2>
    <?php
    $user_id = $_SESSION['auth_user']['id'];
    // displays user orders
    $query = "SELECT * FROM products
              RIGHT JOIN orders
              ON products.id = orders.product_id
              WHERE orders.user_id = '$user_id'";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
      echo "<ul class='orders'>";
      while ($row = mysqli_fetch_object($sql)) :
        echo "<li class='order'>";
        echo $row->name;
        echo "</li>";
      endwhile;
      echo "</ul>";
    } else {
      echo "<p>you didn't purchase any product yet!<p>";
    }
    ?>
    <a class="primary-btn" href="<?php echo DIR; ?>">continue shopping</a>
  </main>
  <footer class="site-footer">
    <p>&copy; <?php echo date('Y'); ?> Simple Shop. All rights reserved.</p>
  </footer>
</body>

</html>