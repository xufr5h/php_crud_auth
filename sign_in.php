<!-- getting started with the php for signing in -->
 <?php
 session_start();
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'database.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    // database connection
    $conn = new Database();
    // check if user exists 
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $hashed_password = sha1(md5($password));
    $result = $conn-> select($sql, [$email, $hashed_password]);
    if (!empty($result)&&count($result) === 1) {
      $user = $result[0];
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_username'] = $user['username'];
      $_SESSION['user_email'] = $user['email'];
      header('Location: dashboard.php');
      exit();
    } else {
      $_SESSION['error'] = 'Invalid email or password';
    }
 }
 ?>
 <!-- getting started with the UI -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="second_container">
      <h2>Sign In</h2>
      <br>
      <form action="" method="POST">
      <label for="email">Email</label> <br>
      <input type="email" name="email" id="email" required> <br>
      <label for="password">Password</label> <br>
      <input type="password" name="password" id="password" required> <br>
      <button type="submit" name="submit">Sign In</button> <br>
      <p>Don't have an account yet? <a href="index.php">Sign Up</a></p>
      <!-- Display error messsage -->
      <?php
      if (isset($_SESSION['error'])) :?>
      <p style="color: red;"><?php echo $_SESSION['error']; ?></p>
      <?php unset($_SESSION['error']); endif; ?>
      </form>
  </div>
</body>
</html>