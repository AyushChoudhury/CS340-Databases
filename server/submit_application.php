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

$applicantID = $positionID = $resumeCV = $coverLetter = "";
$message = $url = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $applicantID = $_POST['applicantID'];
  $positionID = $_POST['positionID'];
  $resumeCV = $_POST['resumeCV'];
  $coverLetter = $_POST['coverLetter'];
  $dateCreated = date('Y-m-d H:i:s');

  $stmt = $mysqli->prepare("SELECT MAX(ApplicationID) AS maxID FROM Applications");
  $stmt->execute();
  $res = $stmt->get_result();
  $applicationID = 0;
  if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $applicationID = $row['maxID'] + 1;
  }

  $stmt = $mysqli->prepare("INSERT INTO Applications (ApplicationID, dateCreated, ResumeCV, CoverLetter, ApplicantID, PositionID) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param('isssii', $applicationID, $dateCreated, $resumeCV, $coverLetter, $applicantID, $positionID);
  $stmt->execute();
  if ($stmt->error == "") {
    $message = "Application submitted!";
    $url = "../employee_dash.php";
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
