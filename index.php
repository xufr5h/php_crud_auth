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
      </form>
  </div>
</body>
</html>