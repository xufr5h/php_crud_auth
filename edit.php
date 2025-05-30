<?php
session_start();
require_once 'database.php';
if ($_GET['id']) {
  $id = $_GET['id'];
  $conn = new Database();
  $finance = $conn->select("SELECT * FROM finance WHERE id = ?", [$_GET['id']]);
  $finance = $finance[0];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $finance_date = $_POST['date'] ?? null;
  $finance_category = $_POST['category'] ?? null;
  $finance_amount = $_POST['amount'] ?? null;
  $finance_payment_method = $_POST['payment_method'] ?? null;
  $finance_description = $_POST['description'] ?? null;
  $user_id = $_SESSION['user_id'];
  if ($finance_date && $finance_category && $finance_amount && $finance_payment_method) {
    $conn = new Database();
    try {
      $returnData = $conn->update("UPDATE finance SET date = ?, category = ?, amount = ?, payment_method = ?, description = ? WHERE id = ?", [$finance_date, $finance_category, $finance_amount, $finance_payment_method, $finance_description, $_GET['id']]);
    header('Location: dashboard.php');
    exit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="create.css">
  <title>Edit expense</title>
</head>
<body>
  <h1>Edit your existing expenditure</h1>
  <form action="edit.php?id=<?php echo $_GET['id'];?>" method="POST">
    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($finance['date']); ?>"required>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($finance['category']); ?>" required>
    </div>
    <div class="form-group">
      <label for="amount">Amount</label>
      <input type="number" name="amount" id="amount" value="<?php echo htmlspecialchars($finance['amount']); ?>" required>
    </div>
    <div class="form-group">
      <label for="payment_method">Payment Method</label>
      <input type="text" name="payment_method" id="payment_method" value="<?php echo htmlspecialchars($finance['payment_method']); ?>" required>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" class="form-control"  rows="5" > <?php echo htmlspecialchars($finance['description']); ?></textarea>
    </div>
    <div class="action">
    <button type="submit" class="create-btn">Update Expense</button>
    <a href="dashboard.php">
    <button type="button" class="back-btn">Go back</button>

    </a>
    </div>
  </form>
</body>
</html>