<?php
require_once 'database.php';
session_start();
// checking if the form is submitted via post method
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $finance_id = $_POST['id'];
  // creating an instance of the database class
$conn = new Database();
// deleting the record from the database
$conn->delete("DELETE FROM finance WHERE id = ?", [$finance_id]);
header('Location: dashboard.php');
} else {
  echo 'Invalid request';
}

?>
