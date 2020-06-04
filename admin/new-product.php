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
    <?php
    // add new product
    if (isset($_POST['submit'])) {
      create_product(
        $conn,
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['image']
      );
    }
    ?>
    <ul class="admin-navigation">
      <li><a href="<?php echo DIRADMIN . 'products.php'; ?>">products</a></li>
      <li><a href="<?php echo DIRADMIN . 'orders.php'; ?>">orders</a></li>
      <li><a href="<?php echo DIRADMIN . 'reviews.php'; ?>">reviews</a></li>
    </ul>
    <div class="admin-page">
      <h1>Add New Product</h1>
      <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <div class="form-control">
          <label for="name">Product Name</label>
          <input type="text" name="name" value="">
        </div>
        <div class="form-control">
          <label for="description">Product Description</label>
          <textarea name="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-control">
          <label for="price">Product Price</label>
          <input type="number" name="price" value="">
        </div>
        <div class="form-control">
          <label for="image">Product Image Url</label>
          <input type="text" name="image" value="">
        </div>
        <input type="submit" name="submit" value="save" />
      </form>
    </div>
  </main>
</body>

</html>