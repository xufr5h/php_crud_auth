<?php
class Database{
  private $host = "localhost";
  private $db_name = "crud_database";
  private $username = "root";
  private $password = "";
  private $port = 3307;
  private $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //throw and exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //fetch associative array
  ];
private $conn;

// constuctor: function which will run automatically when we create an object of this class
public function __construct() {
  try {
    $this -> conn = new PDO(
      "mysql:host=" . $this->host  . ";dbname=" . $this->db_name . ";port=" . $this->port,
      $this->username, 
      $this->password,
      $this->options);
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }
}

public function getConnection(){
  return $this->conn;
} //returns the database connection object 

public function countRows($query, $params = []) {
  $stmt = $this->conn->prepare($query);
  $stmt->execute($params);
  return $stmt->rowCount(); //returns the number of rows affected by the last SQL statement
}

public function create ($query, $params = []) {
  $stmt = $this->conn->prepare($query);
  $stmt->execute($params);
  return $this->conn->lastInsertId(); //returns the ID of the last inserted row or sequence value
}
public function select ($query, $params = []) {
  $stmt = $this->conn->prepare($query);
  $stmt->execute($params);
  return $stmt->fetchAll(); //returns an array containing all of the result set rows
}

public function delete ($query, $params = []) {
  $stmt = $this->conn->prepare($query);
  $stmt->execute($params);
  return $stmt->rowCount(); //returns the number of rows affected by the last SQL statement
}

public function update ($query, $params = []) {
  $stmt = $this->conn->prepare($query);
  $stmt->execute($params);
  return $stmt->rowCount(); //returns the number of rows affected by the last SQL statement
}
}