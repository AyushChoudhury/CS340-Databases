<?php

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['type']);

$url = "./welcome.php";
echo "<script type='text/javascript'>document.location.href = '$url';</script>";

?>
