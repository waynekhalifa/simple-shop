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
  <title>My Account | <?php echo SITETITLE; ?></title>
</head>

<body>
  <header>
    <div>
      <a href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
    </div>
    <ul>
      <li><a href="<?php echo DIR . '?logout'; ?>">logout</a></li>
    </ul>
  </header>
  <main>
    <?php messages() ?>
    <h1>Hi <?php echo $_SESSION['auth_user']['name'] ?></h1>
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
      while ($row = mysqli_fetch_object($sql)) :
        echo "<li>";
        echo $row->name;
        echo "</li>";
      endwhile;
    } else {
      echo "<p>you didn't purchase any product yet!<p>";
    }
    ?>
    <a href="<?php echo DIR; ?>">continue shopping</a>
  </main>
  <footer>footer</footer>
</body>

</html>