<!-- HOME PAGE -->

<!DOCTYPE HTML>

<?php
require "checklogin.php";
ini_set('display_errors', 1);
error_reporting(E_ERROR);
$url = "";

if (isset($_SESSION['id']) && $_SESSION['id'] != null) {
  if ((isset($_SESSION['employee']) && $_SESSION['employee'] != null)
   && (!isset($_SESSION['company']) || $_SESSION['company'] == null)) {
     /* Employee Signed In */
     $url = "./employee_dash.php";
  }
  else if ((isset($_SESSION['company']) && $_SESSION['company'] != null)
   && (!isset($_SESSION['employee']) || $_SESSION['employee'] == null)) {
     /* Company Signed In */
     $url = "./company_dash.php";
  }
}
else {
  $url = "./welcome.php";
}
echo "<script type='text/javascript'>document.location.href = '$url';</script>";
?>
