<?php
// include config to connect to data and use our functions
require 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo DIR . 'assets/css/styles.css'; ?>" type="text/css">
  <!-- google font -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <title>Login | <?php echo SITETITLE; ?></title>
</head>

<body>
  <div class="header-wrapper">
    <div class="container">
      <header class="site-header">
        <a class="logo" href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
        <ul class="navigation">
          <li><a href="<?php echo DIR . 'login.php'; ?>">login</a></li>
          <li><a href="<?php echo DIR . 'register.php'; ?>">register</a></li>
        </ul>
      </header>
    </div>
  </div>
  <main class="container">
    <?php
    if (isset($_POST['submit'])) {
      login($conn, $_POST['email'], $_POST['password']);
    }
    ?>
    <h1 class="page-title">Login</h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <div class="form-control">
        <label for="email">Email</label>
        <input type="email" name="email">
      </div>
      <div class="form-control">
        <label for="password">Password</label>
        <input type="password" name="password">
      </div>
      <input type="submit" name="submit" value="Login" />
    </form>
    <div class="switch">
    <a href="<?php echo DIR; ?>register.php">Don't have an account Register</a>
    </div>
  </main>
  <footer class="site-footer">
    <p>&copy; <?php echo date('Y'); ?> Simple Shop. All rights reserved.</p>
  </footer>
</body>

</html>