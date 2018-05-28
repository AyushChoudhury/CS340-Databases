<!-- COMPANY LOGIN SCRIPT -->

<?php

require "./connectvars.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_error) {
  die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
  $message = "Unable to connect to the database!";
  echo "<script type='text/javascript'>alert('$message');</script>";
  header("Location: ../index.php");
  exit;
}

$email = $password = "";
$message = $url = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $mysqli->prepare("SELECT * FROM Companies WHERE email=?");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();

    // user's stored password that we must compare with
    $pHash = $row['Pass'];
    $iterations = 1000;
    echo $pHash . "<br>";

    // need to get the salt from the hash
    $storedpHash = explode("|", $pHash);// salt of stored password
    echo $storedpHash[0] . "<br>";
    echo $password . "<br>";
    $hash = hash_pbkdf2("sha256",$password, $storedpHash[0], $iterations, 50, false);
    echo $hash . "<br>" . $storedpHash[1];

    if (!strcmp($hash,$storedpHash[1])) {
      // logic after checking hash password
      session_start();
      $_SESSION['id'] = $row['CompanyID'];
      $_SESSION['type'] = 'Company';
      $_SESSION['name'] = $row['Name'];
      $_SESSION['email'] = $email;
      $_SESSION['description'] = $row['Description'];
      echo "<script type='text/javascript'>alert('Welcome!');</script>";
      $url = "../company_dash.php";
    }
    else {
      $message = "Incorrect email/password combination!";
      echo "<script type='text/javascript'>alert('$message');</script>";
      $url = "../login.php";
    }
  }
  else {
    $message = "This email is not associated with an account!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $url = "../login.php";
  }

  $mysqli->close();
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}

$mysqli->close();

?>
