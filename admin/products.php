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
    <h1>All Products</h1>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // list all products

        $sql = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_object($sql)) :
          echo "<tr>";
          echo "<td>" . $row->name . "</td>";
          echo "<td>" . $row->description . "</td>";
          echo "<td>" . $row->price . "</td>";
          echo "<td>";
          echo "<ul>";
          echo "<li><a href='" . DIR . "?product=" . $row->id . "'>view</a></li>";
          echo "<li><a href='" . DIRADMIN . "edit-product.php?product=" . $row->id . "'>edit</a></li>";
          echo "<li><a href='" . DIRADMIN . "products.php?product=" . $row->id . "'>delete</a></li>";
          echo "</ul>";
          echo "</td>";
          echo "</tr>";
        endwhile;

        ?>
      </tbody>
    </table>

  </main>
  <footer>footer</footer>
</body>

</html>