<?php
// include config to connect to data and use our functions
require 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | <?php echo SITETITLE; ?></title>
</head>

<body>

  <header>
    <div>
      <a href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
    </div>
    <ul>
      <?php ?>
      <li><a href="<?php echo DIR . 'login.php'; ?>">login</a></li>
      <li><a href="<?php echo DIR . 'register.php'; ?>">register</a></li>
    </ul>
  </header>
  <main>
    <?php
    if (isset($_POST['submit'])) {
      login($conn, $_POST['email'], $_POST['password']);
    }
    ?>
    <h1>Login</h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <div>
        <label for="email">Email</label>
        <input type="email" name="email">
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" name="password">
      </div>
      <input type="submit" name="submit" value="Login" />
    </form>
    <a href="<?php echo DIR; ?>register.php">Don't have an account Register</a>
  </main>
  <footer>footer</footer>
</body>

</html>