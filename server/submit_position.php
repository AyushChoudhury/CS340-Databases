<?php
session_start();
require "./connectvars.php";
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

$startDate = $industry = $employeeType = $location = $salary = $skillsWanted = $description = $companyID = "";
$message = $url = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $startDate = $_POST['startDate'];
  $industry = $_POST['industry'];
  $employeeType = $_POST['employeeType'];
  $location = $_POST['location'];
  $salary = $_POST['salary'];
  $skillsWanted = $_POST['skillsWanted'];
  $description = $_POST['description'];
  $companyID = $_POST['companyID'];

  $positionID = 0;
  $stmt = $mysqli->prepare("SELECT MAX(PositionID) AS maxID FROM Positions");
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $positionID = $row['maxID'] + 1;
  }

  $stmt = $mysqli->prepare("INSERT INTO Positions (PositionID, StartDate, Industry, EmployeeType, Location, Salary, SkillsWanted, Description, CompanyID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param('issssissi', $positionID, $startDate, $industry, $employeeType, $location, $salary, $skillsWanted, $description, $companyID);
  $stmt->execute();
  if ($stmt->error == "") {
    $message = "Position created!";
    $url = "../company_dash.php";
  }
  else {
    $message = "Error creating position: " . $stmt->error;
    $url = "../create_position.php";
  }
  echo "<script type='text/javascript'>alert('$message');</script>";
  $mysqli->close();
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}

$mysqli->close();

?>
