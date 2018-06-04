<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['type']);
unset($_SESSION['email']);
unset($_SESSION['birthdate']);
unset($_SESSION['skills']);
unset($_SESSION['description']);

session_destroy();

$url = "./welcome.php";
echo "<script type='text/javascript'>document.location.href = '$url';</script>";

?>
