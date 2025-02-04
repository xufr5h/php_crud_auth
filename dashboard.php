<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: sign_in.php');
  exit;
}
require 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="dashboard.css">
  <title>Dashboard</title>
</head>
<body>
  <h2>Expenditure Management System</h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col" class="w-2">S.N.</th>
      <th scope="col" class="w-10">Date</th>
      <th scope="col" class="w-15">Category</th>
      <th scope="col" class="w-10">Amount</th>
      <th scope="col" class="w-10">Payment Method</th>
      <th scope="col" class="w-25 text-wrap">Description</th>
      <th scope="col" class="w-15">Actions</th>
    </tr>
    <?php
$db = new Database();
$finance = $db->select("SELECT * FROM finance");
$i=1; //Initializing the counter variable for the serial number 
foreach ($finance as $finance): 
?>
<tr>
  <td><?=$i++; ?></td> <!-- Increment of the serial number -->
  <td><?=$finance['date'] ?></td>
  <td><?=$finance['category']?></td>
  <td><?=$finance['amount']?></td>
  <td><?=$finance['payment_method']?></td>
  <td><?=$finance['description']?></td>
  <!-- adding the action buttons -->
  <td class="action">
    <a href="edit.php?id=<?=$finance['id'];?>" class="btn btn-warning btn-sm">Edit</a>
    <button type="button" class="btn btn-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?=$finance['id'];?>">
        Delete
    </button>
  </td>
</tr>
<?php endforeach; ?>
  </thead>
</table>
<!-- Bootstrap Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm"> <!-- Small modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this expenditure data?
      </div>
      <div class="modal-footer text-center"> <!-- Buttons side by side -->
        <div class="w-100 d-flex justify-content-center gap-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST" action="delete.php">
          <input type="hidden" name="id" id="deleteId">
          <button type="submit" class="btn btn-danger-modal">Delete</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
<a href="create.php">
<button>Add expense</button>
</a
><div class="user-info">
  <p class="d-line">Logged in as: <?=$_SESSION['user_username'] ?? 'N/A' ?></p>
</div>
<script>
  // Capture the delete button click event to set the ID dynamically
  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {
      let id = this.getAttribute('data-id');
      document.getElementById('deleteId').value = id;
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>