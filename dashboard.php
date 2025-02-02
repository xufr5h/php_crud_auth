<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Dashboard</title>
</head>
<body>
  <h2>Expenditure Management System</h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">S.N.</th>
      <th scope="col">Date</th>
      <th scope="col">Category</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment Method</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
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
  <td>
    <a href="edit.php?id=<?=$finance['id'];?>" class="btn btn-warning btn-sm">Edit</a>
    <form action="delete.php" method="POST" >
    <div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this data?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>
    </form>
  </td>
</tr>
<?php endforeach; ?>
  </thead>
</table>
<div class="user-info">
  <p class="d-line">Logged in as: <?=$_SESSION['username'] ?? 'N/A' ?></p>
  <a href="logout.php" class="btn btn-secondary btn-sm d-line">logout</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>