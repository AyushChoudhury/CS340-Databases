<!-- COMPANY SIGNUP SCRIPT -->

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

$name = $email = $password = $description = "";
$message = $url = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $description = $_POST['description'];

  $stmt = $mysqli->prepare("SELECT email FROM Companies WHERE email=?");
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

    $stmt = $mysqli->prepare("SELECT MAX(CompanyID) AS maxID FROM Companies");
    $stmt->execute();
    $res = $stmt->get_result();
    $id = 0;
    if ($res->num_rows > 0) {
      $row = $res->fetch_assoc();
      $id = $row['maxID'] + 1;
    }

    $stmt = $mysqli->prepare("INSERT INTO Companies (CompanyID, Name, Email, Pass, Description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('issss', $id, $name, $email, $hashandSalt, $description);
    $stmt->execute();
    if ($stmt->error == "") {
      session_start();
      $_SESSION['id'] = $id;
      $_SESSION['type'] = 'Company';
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['description'] = $description;
      echo "<script type='text/javascript'>alert('Welcome!');</script>";
      $url = "../company_dash.php";
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
