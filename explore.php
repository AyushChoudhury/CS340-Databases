<!-- EXPLORE PAGE -->

<!DOCTYPE HTML>

<?php
require "checklogin.php";
ini_set('display_errors', 1);
error_reporting(E_ERROR);

if (isset($_SESSION['id']) && $_SESSION['id'] != null) {
  $url = "./index.php";
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
else {
  ?>

  <html>
  <head>
    <title>Explore - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("employeeheader.html");
    });
    </script>
  </head>
  <body>
    <div class="siteheader" id="siteheader"></div>

    <div class="mainbody">
      <left class="sectionheader"><h1>Explore</h1></left>
      <div class="ui divider"></div><br>

    </div>
  </body>
  </html>

  <?php
  $mysqli->close();
}
?>
