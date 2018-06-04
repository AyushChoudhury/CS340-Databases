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

$name = $email = $password = $birthdate = $skills = "";
$message = $url = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $birthdate = $_POST['birthdate'];
  $skills = $_POST['skills'];

  $stmt = $mysqli->prepare("SELECT email FROM Applicants WHERE email=?");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows > 0) {
    $message = "There is already a user with this email!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $url = "../signup.php";
  }
  else {
    $iterations = 1000;

    $salt = "";
		$alphanumchars = 'abcdefghijklmnopqrstuvwxyz0123456789';
		for ($i = 0; $i < 16; $i++) {
			$salt .= $alphanumchars[mt_rand(0, strlen($alphanumchars)-1)];
		}
    $hash = hash_pbkdf2("sha256",$password, $salt, $iterations, 50, false);

    // store salt with hash
    $hashandSalt = $salt . '|' . $hash;

    $stmt = $mysqli->prepare("SELECT MAX(ApplicantID) AS maxID FROM Applicants");
    $stmt->execute();
    $res = $stmt->get_result();
    $id = 0;
    if ($res->num_rows > 0) {
      $row = $res->fetch_assoc();
      $id = $row['maxID'] + 1;
    }

    $stmt = $mysqli->prepare("INSERT INTO Applicants (ApplicantID, Name, Email, Pass, Birthdate, Skills) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssss', $id, $name, $email, $hashandSalt, $birthdate, $skills);
    $stmt->execute();
    if ($stmt->error == "") {
      $_SESSION['id'] = $id;
      $_SESSION['type'] = 'Employee';
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['birthdate'] = $birthdate;
      $_SESSION['skills'] = $skills;
      echo "<script type='text/javascript'>alert('Welcome!');</script>";
      $url = "../employee_dash.php";
    }
    else {
      echo $stmt->error;
      $message = "Error creating account!";
      echo "<script type='text/javascript'>alert('$message');</script>";
      $url = "../signup.php";
    }
  }
  $mysqli->close();
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";

}

$mysqli->close();

?>
