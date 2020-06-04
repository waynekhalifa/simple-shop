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
      <li><a href="<?php echo DIRADMIN . 'products.php'; ?>">products</a></li>
      <li><a href="<?php echo DIRADMIN . 'orders.php'; ?>">orders</a></li>
      <li><a href="<?php echo DIRADMIN . 'reviews.php'; ?>">reviews</a></li>
    </ul>
    <h1>Reviews</h1>
    <table>
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Reviewer Name</th>
          <th>Comment</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // list all products

        $query = "SELECT
                    users.name AS user_name,
                    products.name AS product_name,
                    comment
                  FROM reviews
                  INNER JOIN users
                    ON reviews.user_id = users.id
                  INNER JOIN products
                    ON reviews.product_id = products.id";
        $sql = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_object($sql)) :
          echo "<tr>";
          echo "<td>" . $row->product_name . "</td>";
          echo "<td>" . $row->user_name . "</td>";
          echo "<td>" . $row->comment . "</td>";
          echo "</tr>";
        endwhile;

        ?>
      </tbody>
    </table>
  </main>
  <footer>footer</footer>
</body>

</html>