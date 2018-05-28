<!-- HOME PAGE -->

<!DOCTYPE HTML>

<?php
require "checklogin.php";
ini_set('display_errors', 1);
error_reporting(E_ERROR);
$url = "";

if (isset($_SESSION['id']) && isset($_SESSION['type'])) {
  if ($_SESSION['type'] == 'Employee') {
     /* Employee Signed In */
     $url = "./employee_dash.php";
  }
  else if ($_SESSION['type'] == 'Company') {
     /* Company Signed In */
     $url = "./company_dash.php";
  }
}
else {
  $url = "./welcome.php";
}
echo "<script type='text/javascript'>document.location.href = '$url';</script>";
?>
