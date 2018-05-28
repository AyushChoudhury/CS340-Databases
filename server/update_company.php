<?php
require "./server/connectvars.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);
if (!isset($_SESSION['id']) || $_SESSION['type'] != 'Company') {
  $url = "./index.php";
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

 if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    $message = "Unable to connect to the database!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location: ../index.php");
    exit;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["Name"];
  $email = $_POST["Email"];
  $password = $_POST["Pass"];
  $description = $_POST["Description"];



$stmt = $mysqli->prepare("UPDATE Companies SET name=?, email=?, password=?, description=? WHERE CompanyID=?");
$stmt->bind_param('isssii', $name, $email, $password, $description);
$stmt->execute();
  
  if ($stmt->error == "") {
    $message = "Application submitted!";
    $url = "../company_settings.php";
  }
  else {
    echo $stmt->error;
    sleep(5);
    $message = "Error submitting application: " . $stmt->error;
    $url = "../explore.php";
  }
  echo "<script type='text/javascript'>alert('$message');</script>";
  $mysqli->close();
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
$mysqli->close();
?>
