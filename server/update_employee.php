<?php
session_start();
require "./connectvars.php";
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
  $applicantID = $_POST["applicantID"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $birthdate = $_POST["birthdate"];
  $skills = $_POST["skills"];

  $stmt = $mysqli->prepare("UPDATE Applicants SET Name=?, Email=?, Birthdate=?, Skills=? WHERE ApplicantID=?");
  $stmt->bind_param('ssssi', $name, $email, $birthdate, $skills, $applicantID);
  $stmt->execute();

  if ($stmt->error == "") {
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['birthdate'] = $birthdate;
    $_SESSION['skills'] = $skills;
    $message = "Settings updated!";
  }
  else {
    $message = "Error updating settings: " . $stmt->error;
  }
  $url = "../employee_settings.php";
  echo "<script type='text/javascript'>alert('$message');</script>";
  $mysqli->close();
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
$mysqli->close();
?>
