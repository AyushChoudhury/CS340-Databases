<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);

if (isset($_SESSION['id']) && isset($_SESSION['type'])) {
    echo "<script type='text/javascript'>alert('Welcome back!');</script>";
  if ($_SESSION['type'] == 'Employee') {
    $url = "./employee_dash.php";
    echo "<script type='text/javascript'>document.location.href = '$url';</script>";
  }
  else if ($_SESSION['type'] == 'Company') {
    $url = "./company_dash.php";
    echo "<script type='text/javascript'>document.location.href = '$url';</script>";
  }
}
else {
  ?>

  <!DOCTYPE HTML>

  <html>
  <head>
    <title>Welcome - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("welcomeheader.html");
    });
    </script>
  </head>
  <body>
    <div class="siteheader" id="siteheader"></div>

    <div class="mainbody">
      <center>
        <div class="welcomebody">
          <h1>Welcome to FindMeAJob!</h1>
          <h3>
            Looking for an easy way to find jobs that work for you?
            You've come to the right place!
          </h3>
          <br>
          <a href="./signup.php">
            <button class="circular ui icon button cs">
              <i class="lock icon" style="color:black"></i>
              <p style="color:black">Sign Up</p>
            </button>
          </a>
          <a href="./login.php">
            <button class="circular ui icon button cs">
              <i class="plus icon" style="color:black"></i>
              <p style="color:black">Log In</p>
            </button>
          </a>
        </div>
      </center>
    </div>
  </body>
  </html>

  <?php
}
?>
