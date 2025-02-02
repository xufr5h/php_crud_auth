<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Including the database connection
  require_once 'database.php';
  // get form data
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);
  // validate form data
  if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    $error = 'All fields are required';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid email format';
  } else if ($password !== $confirm_password) {
    $error = 'Passwords do not match';
  } else {
    $conn = new Database();
    // checking if the email address already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $count = $conn->countRows($sql, [$email]);
    if ($count>0) {
      $error = "This email is already registered";
    } else {
      // Inserting new user into database 
      $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
      $hashed_password = sha1(md5($password)); // hashing the password
      $returnId = $conn->create($sql, [$username, $email, $hashed_password]);
      if ($returnId) {
        header('Location: sign_in.php');
        exit();
      } else {
        $error = "An error occurred. Please try again";
    }
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign UP</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="second_container">
      <h2>Sign Up</h2>
      <br>
      <form action="" method="POST">
      <label for="username">Username</label> <br>
      <input type="text" name="username" id="username" required> <br>
      <label for="email">Email</label> <br>
      <input type="email" name="email" id="email" required> <br>
      <label for="password">Password</label> <br>
      <input type="password" name="password" id="password" required> <br>
      <label for="confirm_password">Confirm Password</label> <br>
      <input type="password" name="confirm_password" id="confirm_password" required> <br>
      <button type="submit" name="submit">Sign Up</button> <br>
      <p>Already have an account? <a href="sign_in.php">Sign In</a></p>
      <!-- Display error messsage -->
       <?php
       if (!empty($error)) : ?> 
        <p style="color:red"><?php echo $error; ?></p>
       <?php endif; ?>
      </form>
  </div>
</body>
</html>
