<!DOCTYPE HTML>

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
