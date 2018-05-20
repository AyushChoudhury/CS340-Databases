<!-- SIGNUP PAGE -->

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
    <title>Sign Up - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("welcomeheader.html");
    });

    function toggleForm() {
      var typeField = document.getElementById("type").value;
      var employeeForm = document.getElementById("employee");
      var companyForm = document.getElementById("company");
      if (typeField == 1) {
        employeeForm.style.display = "block";
        companyForm.style.display = "none";
      }
      else {
        employeeForm.style.display = "none";
        companyForm.style.display = "block";
      }
    }
    </script>
  </head>
  <body>
    <div class="siteheader" id="siteheader"></div>

    <div class="mainbody">
      <left class="sectionheader"><h1>Sign Up</h1></left>
      <div class="ui divider"></div><br>

      <p class="requirednote">* Denotes a required field</p><br>

      <table style="width:100%">
        <tr>
          <td style="width:50%">
            <!-- Employee Signup Form -->
            <h2>Prospective Employees</h2>
            <form name="employeeForm" onsubmit="return validateEmployeeForm()" action="./server/employee_signup.php" method="post" id="employeeForm">
              <div class="elem">
                <span class="requirednote">*</span>
                Name: <input class="inputbox" type="text" name="name"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Email: <input class="inputbox" type="email" name="email"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Password: <input class="inputbox" type="password" name="password"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Birth Date: <input class="inputbox" type="date" name="birthdate"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Skills (separate each skill by a comma):<br><br> <input class="inputbox" type="text" name="skills"><br><br>
              </div>
              <input class="ui blue button" type="submit" value="Sign Up!">
            </form>
          </td>
          <td style="width:50%">
            <!-- Company Signup Form -->
            <h2>Companies</h2>
            <form name="companyForm" onsubmit="return validateCompanyForm()" action="./server/company_signup.php" method="post" id="companyForm">
              <div class="elem">
                <span class="requirednote">*</span>
                Company Name: <input class="inputbox" type="text" name="name"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Email: <input class="inputbox" type="email" name="email"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Password: <input class="inputbox" type="password" name="password"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Company Description:<br><br> <input class="inputbox" type="text" name="description"><br><br>
              </div>
              <input class="ui blue button" type="submit" value="Sign Up!">
            </form>
          </td>
        </tr>
      </table>
    </div>
  </body>
  </html>

  <?php
  $mysqli->close();
}
?>
