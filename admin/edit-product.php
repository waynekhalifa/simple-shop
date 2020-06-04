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
    <?php
    // get product based on url id
    if (isset($_GET['product'])) :
      $id = $_GET['product'];
      $id = mysqli_real_escape_string($conn, $id);
      $sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
      $product = mysqli_fetch_object($sql);
    endif;

    // update the product
    if (isset($_POST['submit'])) {
      edit_product(
        $conn,
        $_POST['product_id'],
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['image']
      );
    }
    ?>
    <ul>
      <li><a href="<?php echo DIRADMIN . 'products.php'; ?>">all products</a></li>
      <li><a href="<?php echo DIRADMIN . 'new-product.php'; ?>">new products</a></li>
      <li><a href="<?php echo DIRADMIN . 'edit-product.php'; ?>">edit products</a></li>
      <li><a href="<?php echo DIRADMIN . 'orders.php'; ?>">all orders</a></li>
      <li><a href="<?php echo DIRADMIN . 'reviews.php'; ?>">all reviews</a></li>
    </ul>
    <h1>Edit <?php echo $product->name; ?></h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <div>
        <label for="name">Product Name</label>
        <input type="text" name="name" value="<?php echo $product->name; ?>">
      </div>
      <div>
        <label for="description">Product Description</label>
        <textarea name="description" cols="30" rows="10">
        <?php echo $product->description; ?>
      </textarea>
      </div>
      <div>
        <label for="price">Product Price</label>
        <input type="number" name="price" value="<?php echo $product->price; ?>">
      </div>
      <div>
        <label for="image">Product Image Url</label>
        <input type="text" name="image" value="<?php echo $product->image; ?>">
      </div>
      <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
      <input type="submit" name="submit" value="update" />
    </form>
  </main>
  <footer>footer</footer>
</body>

</html>