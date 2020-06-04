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
  <link rel="stylesheet" href="<?php echo DIR . 'assets/css/styles.css'; ?>" type="text/css">
  <!-- google font -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <title><?php echo SITETITLE; ?></title>
</head>

<body>

  <div class="header-wrapper">
    <div class="container">
      <header class="site-header">
        <a class="logo" href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
        <ul class="navigation">
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
    </div>
  </div>
  <main class="container">
    <?php
    // review product
    if (isset($_POST['submit'])) {
      $user_id = $_SESSION['auth_user']['id'];
      $product_id = $_POST['product'];
      $comment = $_POST['review'];
      review_product($conn, $user_id, $product_id, $comment);
    }

    // check if we have product id then display single product
    if (isset($_GET['product'])) :
      $id = $_GET['product'];
      $id = mysqli_real_escape_string($conn, $id);
      $sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
      $product = mysqli_fetch_object($sql);

      echo "<h1 class='page-title'>" . $product->name . "</h1>";
      echo "<div class='product-page'>";
      echo "<img src='" . DIR . "assets/images/" . $product->image . "' alt='" . $product->name . "' />";
      echo "<div class='product-content'>";
      echo "<p class='product-name'>" . $product->name . "</p>";
      echo "<p class='product-desc'>" . $product->description . "</p>";
      echo "<p class='product-price'>$" . $product->price . "</p>";
      echo "<a class='purchase' href='" . DIR . "my-account.php?product=" . $product->id . "'>purchase</a>";
      echo "</div>";
      echo "</div>";

      // list all products reviews
      $query = "SELECT * FROM reviews
      LEFT JOIN users
      ON reviews.user_id = users.id
      WHERE reviews.product_id = '$id'";

      $sql = mysqli_query($conn, $query);
      echo "<ul class='reviews'>";
      while ($row = mysqli_fetch_object($sql)) :
        echo "<li class='review'>";
        echo "<p class='reviewer'>" . $row->name . "</p>";
        echo "<p class='comment'>" . $row->comment . "</p>";
        echo "</li>";
      endwhile;
      echo "</ul>";


      // display review form
      if (logged_in()) : ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
          <input type="hidden" name="product" value="<?php echo $id; ?>">
          <div class="form-control">
            <label for="review">Review Product</label>
            <textarea name="review" cols="30" rows="10">
          </textarea>
          </div>
          <input type="submit" name="submit" value="review product">
        </form>
    <?php
      else :
        echo '<p>You have to login to review the product</p>';
      endif;
    else :
      // list all products
      echo "<ul class='products'>";
      $sql = mysqli_query($conn, "SELECT * FROM products");
      while ($row = mysqli_fetch_object($sql)) :
        echo "<li class='product'>";
        echo "<a href='" . DIR . "?product=" . $row->id . "'>";
        echo "<img src='" . DIR . "assets/images/" . $row->image . "' alt='" . $row->name . "' />";
        echo "</a>";
        echo "<div class='product-meta'>";
        echo "<p class='product-name'>" . $row->name . "</p>";
        echo "<p class='product-price'>$" . $row->price . "</p>";
        echo "<a class='purchase' href='" . DIR . "my-account.php?product=" . $row->id . "'>purchase</a>";
        echo "</div>";
        echo "</li>";
      endwhile;
      echo "</ul>";
    endif;
    ?>
  </main>

  <footer class="site-footer">
    <p>&copy; <?php echo date('Y'); ?> Simple Shop. All rights reserved.</p>
  </footer>
</body>

</html>