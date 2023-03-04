<?php
session_start();

// Connect to MongoDB
$mongo = new MongoClient("mongodb://localhost:27017");
$db = $mongo->mydb;
$collection = $db->users;

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $query = array("username" => $username, "password" => $password);
  $user = $collection->findOne($query);

  if ($user) {
    $_SESSION["username"] = $username;
    header("Location: profile.php");
    exit();
  } else {
    $error = "Invalid username or password.";
  }
}

// Handle registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $query = array("username" => $username);
  $user = $collection->findOne($query);

  if ($user) {
    $error = "Username already taken.";
  } else {
    $doc = array("username" => $username, "password" => $password);
    $collection->insert($doc);

    $_SESSION["username"] = $username;
    header("Location: profile.php");
    exit();
  }
}
?>
