<?php
require "./connectvars.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if ($mysqli->connect_error) {
  die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
  $message = "Unable to connect to the database!";
  echo "<script type='text/javascript'>alert('$message');</script>";
  header("Location: ../index.php");
  exit;
}

$name = $email = $password = $description = "";
$message = $url = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $companyID = $_POST["companyID"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $description = $_POST["description"];

  $stmt = $mysqli->prepare("UPDATE Companies SET Name=?, Email=?, Description=? WHERE CompanyID=?");
  $stmt->bind_param('sssi', $name, $email, $description, $companyID);
  $stmt->execute();

  if ($stmt->error == "") {
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['description'] = $description;
    $message = "Settings updated!";
  }
  else {
    echo $stmt->error;
    sleep(5);
    $message = "Error submitting application: " . $stmt->error;
  }
  $url = "../company_settings.php";
  echo "<script type='text/javascript'>alert('$message');</script>";
  $mysqli->close();
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
$mysqli->close();
?>
