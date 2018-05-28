<?php

require "./connectvars.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//Output any connection error
if ($mysqli->connect_error) {
  die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
  $message = "Unable to connect to the database!";
  echo "<script type='text/javascript'>alert('$message');</script>";
  header("Location: ../index.php");
  exit;
}

$applicantID = $companyID = $rating = $comment = "";
$message = $url = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $applicantID = $_POST['applicantID'];
  $companyID = $_POST['chooseco'];
  $rating = $_POST['rating'];
  $comment = $_POST['comment'];

  $stmt = $mysqli->prepare("INSERT INTO Feedback (Rating, Comment, ApplicantID, CompanyID) VALUES (?, ?, ?, ?)");
  $stmt->bind_param('isii', $rating, $comment, $applicantID, $companyID);
  $stmt->execute();

  if ($stmt->error == "") {
    $message = "Feedback recorded!";
    $url = "../employee_dash.php";
  }
  else {
    $message = "Error recording feedback: " . $stmt->error;
    $url = "../leave_feedback.php";
  }
  echo "<script type='text/javascript'>alert('$message');</script>";
  $mysqli->close();
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}

$mysqli->close();

?>
