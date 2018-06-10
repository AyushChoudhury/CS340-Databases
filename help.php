<?php
session_start();
require "./server/connectvars.php";
ini_set('display_errors', 1);
error_reporting(E_ERROR);
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
    <?php if (isset($_SESSION['id'])) {
      if ($_SESSION['type'] == 'Employee') { ?>
        $("#siteheader").load("employeeheader.html");
      <?php } else if ($_SESSION['type'] == 'Company') { ?>
        $("#siteheader").load("companyheader.html");
      <?php }
    } else { ?>
      $("#siteheader").load("welcomeheader.html");
    <?php } ?>
    $("#empbtn").click(function() {
      document.getElementById("emphelp").scrollIntoView();
    });
    $("#combtn").click(function() {
      document.getElementById("comhelp").scrollIntoView();
    })
  });
  </script>
</head>
<body>
  <div class="siteheader" id="siteheader"></div>

  <div class="mainbody">
    <left class="sectionheader"><h1>Help</h1></left>
    <div class="ui divider"></div><br>

    <div>
      <button class="ui blue button" id="empbtn">Prospective Employees</button>
      <button class="ui blue button" id="combtn">Companies</button>
    </div><br>

    <div id="emphelp">
      <h2>Prospective Employees</h2>
      <div>
        <h3>Sign Up</h3>
        <p>Home > Sign Up > Fill out each field under the Prospective Employee header, then click "Sign Up!"</p>
      </div><br>
      <div>
        <h3>Log In</h3>
        <p>Home > Log In > Enter your email and password under the Prospective Employee header, then click "Log In."</p>
      </div><br>
      <div>
        <h3>View Recently Submitted Applications</h3>
        <p>[After logging in] Go to your dashboard.</p>
      </div><br>
      <div>
        <h3>Explore Available Positions</h3>
        <p>[After logging in] Click "Explore" in the navigation bar.</p>
      </div><br>
      <div>
        <h3>Apply for a Position</h3>
        <p>[After logging in] Explore > Click the green "Apply!" button.</p>
        <p>Then enter your resume/CV, cover letter, and optional reference in the text fields.</p>
        <p>Click "Submit Application."</p>
      </div><br>
      <div>
        <h3>Leave Feedback for a Company</h3>
        <p>[After logging in] Click Leave Company Feedback in the navigation bar.</p>
        <p>Then pick the company you want to leave feedback for, leave your rating and comment, and click "Submit Feedback."</p>
      </div><br>
      <div>
        <h3>Update Account Information</h3>
        <p>[After logging in] Settings > Modify your name, email, birth date, or list of skills, then click "Save Changes."</p>
      </div><br>
    </div>
    <div class="ui divider"></div><br>
    <div id="comhelp">
      <h2>Companies</h2>
      <div>
        <h3>Sign Up</h3>
        <p>Home > Sign Up > Fill out each field under the Prospective Employee header, then click "Sign Up!"</p>
      </div><br>
      <div>
        <h3>Log In</h3>
        <p>Home > Log In > Enter your email and password under the Company header, then click "Log In"</p>
      </div><br>
      <div>
        <h3>View Upcoming Positions</h3>
        <p>[After logging in] Go to your dashboard.</p>
      </div><br>
      <div>
        <h3>Create a New Position</h3>
        <p>[After logging in] Create Position > Enter the information for the position and click "Create Position."</p>
      </div><br>
      <div>
        <h3>View Positions</h3>
        <p>[After logging in] Click "View Positions" in the navigation bar</p>
      </div><br>
      <div>
        <h3>View Applicants for a Specific Position</h3>
        <p>[After logging in] View Positions > Click "View Applicants" for the position you'd like to see the applicants and applications for.</p>
      </div><br>
      <div>
        <h3>View Feedback from Employees and Applicants</h3>
        <p>[After logging in] Click "View User Feedback" in the navigation bar.</p>
      </div><br>
      <div>
        <h3>Update Account Information</h3>
        <p>[After logging in] Settings > Modify your name, email, or company description, then click "Save Changes."</p>
      </div><br>
    </div>

  </div>
</body>
</html>
