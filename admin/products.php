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
          <li><a href="<?php echo DIR . '?logout'; ?>">logout</a></li>
          <li><a href="<?php echo DIR; ?>">visit site</a></li>
        </ul>
      </header>
    </div>
  </div>
  <main class="admin-content">
    <ul class="admin-navigation">
      <li><a href="<?php echo DIRADMIN . 'products.php'; ?>">products</a></li>
      <li><a href="<?php echo DIRADMIN . 'orders.php'; ?>">orders</a></li>
      <li><a href="<?php echo DIRADMIN . 'reviews.php'; ?>">reviews</a></li>
    </ul>
    <?php
    // delete product
    if (isset($_GET['product'])) {
      delete_product($conn, $_GET['product']);
    }
    ?>
    <div class="admin-page">
      <?php /*display success messages*/ messages(); ?>
      <div class="products-header">
        <h1>All Products</h1>
        <a href="<?php echo DIRADMIN . 'new-product.php'; ?>">new products</a>
      </div>
      <div class="admin-products">
        <div class="grid-item">Name</div>
        <div class="grid-item">Price</div>
        <div class="grid-item">Actions</div>
        <?php
        // list all products

        $sql = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_object($sql)) :
          echo "<div class='grid-item'>" . $row->name . "</div>";
          echo "<div class='grid-item'>$" . $row->price . "</div>";
          echo "<div class='grid-item'>";
          echo "<ul class='products-actions'>";
          echo "<li><a href='" . DIR . "?product=" . $row->id . "'>view</a></li>";
          echo "<li><a href='" . DIRADMIN . "edit-product.php?product=" . $row->id . "'>edit</a></li>";
          echo "<li><a href='" . DIRADMIN . "products.php?product=" . $row->id . "'>delete</a></li>";
          echo "</ul>";
          echo "</div>";
        endwhile;
        ?>
      </div>
    </div>
  </main>
</body>

</html>