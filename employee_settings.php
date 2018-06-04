<?php
session_start();
require "./server/connectvars.php";
ini_set('display_errors', 1);
error_reporting(E_ERROR);

if (!isset($_SESSION['id']) || $_SESSION['type'] != 'Employee') {
  $url = "./index.php";
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
else {
  ?>

  <!DOCTYPE HTML>

  <html>
  <head>
    <title>Settings - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("employeeheader.html");
    });

    function validateEmployeeForm() {
      var nameField = document.forms['employeeForm']['name'];
      var emailField = document.forms['employeeForm']['email'];
      var birthdateField = document.forms['employeeForm']['birthdate'];
      var skillsField = document.forms['employeeForm']['skills'];
      if (nameField == null || nameField == "" ||
          emailField == null || emailField == "" ||
          birthdateField == null || birthdateField == "" ||
          skillsField == null || skillsField == "") {
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
      <left class="sectionheader"><h1>Settings</h1></left>
      <div class="ui divider"></div><br>

      <form name="employeeForm" onsubmit="return validateEmployeeForm()" action="./server/update_employee.php" method="post" id="employeeForm">
        <div class="elem" style="display: none">
           <input class="inputbox" type="number" name="applicantID" value="<?php echo $_SESSION['id']; ?>" readonly>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Name: <input class="inputbox" type="text" name="name" value="<?php echo $_SESSION['name']; ?>"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Email: <input class="inputbox" type="email" name="email" value="<?php echo $_SESSION['email']; ?>"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Birth Date: <input class="inputbox" type="date" name="birthdate" value=<?php echo $_SESSION['birthdate']; ?>><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Skills (separate each skill by a comma):<br><br> <input class="inputbox" type="text" name="skills" value="<?php echo $_SESSION['skills']; ?>"><br><br>
        </div>
        <input class="ui blue button" type="submit" value="Save Changes">
      </form>

    </div>
  </body>
  </html>

  <?php
}
?>
