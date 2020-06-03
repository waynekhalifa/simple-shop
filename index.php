<?php
// include config to connect to data and use our functions
require 'includes/config.php';

//if logout has been clicked run the logout function which will destroy any active sessions and redirect to the login page
if (isset($_GET['logout'])) {
  logout();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo SITETITLE; ?></title>
</head>

<body>

  <header>
    <div>
      <a href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
    </div>
    <ul>
      <?php if (logged_in()) : ?>
        <li><a href="<?php echo DIR . 'my-account.php'; ?>">my account</a></li>
        <li><a href="<?php echo DIR . '?logout'; ?>">logout</a></li>
      <?php else : ?>
        <li><a href="<?php echo DIR . 'login.php'; ?>">login</a></li>
        <li><a href="<?php echo DIR . 'register.php'; ?>">register</a></li>
      <?php endif; ?>
      <?php if (admin()) : ?>
        <li><a href="<?php echo DIRADMIN; ?>">admin dashboard</a></li>
      <?php endif; ?>
    </ul>
  </header>
  <main>
    <?php
    // check if we have product id then display single product
    if (isset($_GET['product'])) :
      $id = $_GET['product'];
      $id = mysqli_real_escape_string($conn, $id);
      $sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
      $product = mysqli_fetch_object($sql);

      echo "<h1>" . $product->name . "</h1>";
    else :
      // list all products
      echo "<ul>";
      $sql = mysqli_query($conn, "SELECT * FROM products");
      while ($row = mysqli_fetch_object($sql)) :
        echo "<li>";
        echo "<a href='" . DIR . "?product=" . $row->id . "'>" . $row->name . "</a>";
        echo "<a href='" . DIR . "my-account.php?product=" . $row->id . "'>purchase</a>";
        echo "</li>";
      endwhile;
      echo "</ul>";
    endif;
    ?>
  </main>

  <footer>footer</footer>
</body>

</html>