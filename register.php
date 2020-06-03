<?php
// include config to connect to data and use our functions
require 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | <?php echo SITETITLE; ?></title>
</head>

<body>

  <header>
    <div>
      <a href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
    </div>
    <ul>
      <li><a href="<?php echo DIR . 'login.php'; ?>">login</a></li>
      <li><a href="<?php echo DIR . 'register.php'; ?>">register</a></li>
    </ul>
  </header>
  <main>
    <?php
    if (isset($_POST['submit'])) {
      register($conn, $_POST['name'], $_POST['email'], $_POST['password']);
    }
    ?>
    <h1>Register</h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <div>
        <label for="name">Full Name</label>
        <input type="name" name="name">
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" name="email">
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" name="password">
      </div>
      <input type="submit" name="submit" value="Register" />
    </form>
    <a href="<?php echo DIR; ?>login.php">Already have an account Login</a>
  </main>
  <footer>footer</footer>
</body>

</html>