<!-- LOGIN PAGE -->

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
    <title>Log In - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("welcomeheader.html");
    });

    function validateEmployeeForm() {
      var emailField = document.forms['employeeForm']['email'];
      var passwordField = document.forms['employeeForm']['password'];
      if (emailField == null || emailField == "" ||
          passwordField == null || passwordField == "") {
        alert("Please fill all required fields before submitting!");
        return false;
      }
      else return true;
    }

    function validateCompanyForm() {
      var emailField = document.forms['companyForm']['email'];
      var passwordField = document.forms['companyForm']['password'];
      if (emailField == null || emailField == "" ||
          passwordField == null || passwordField == "") {
        alert("Please fill all required fields before submitting!");
        return false;
      }
      else return true;
    }
    </script>
  </head>
  <body>
    <div class="siteheader" id="siteheader"></div>

    <div class="mainbody">
      <left class="sectionheader"><h1>Log In</h1></left>
      <div class="ui divider"></div><br>

      <p class="requirednote">* Denotes a required field</p><br>

      <table style="width:100%">
        <tr>
          <td style="width:50%">
            <!-- Employee Login Form -->
            <h2>Prospective Employees</h2>
            <form name="employeeForm" onsubmit="return validateEmployeeForm()" action="./server/employee_login.php" method="post" id="employeeForm">
              <div class="elem">
                <span class="requirednote">*</span>
                Email: <input class="inputbox" type="email" name="email"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Password: <input class="inputbox" type="password" name="password"><br><br>
              </div>
              <input class="ui blue button" type="submit" value="Log In">
            </form>
          </td>
          <td style="width:50%">
            <!-- Company Login Form -->
            <h2>Companies</h2>
            <form name="companyForm" onsubmit="return validateCompanyForm()" action="./server/company_login.php" method="post" id="companyForm">
              <div class="elem">
                <span class="requirednote">*</span>
                Email: <input class="inputbox" type="email" name="email"><br><br>
              </div>
              <div class="elem">
                <span class="requirednote">*</span>
                Password: <input class="inputbox" type="password" name="password"><br><br>
              </div>
              <input class="ui blue button" type="submit" value="Log In">
            </form>
          </td>
        </tr>
      </table>
    </div>
  </body>
  </html>

  <?php
}
?>
