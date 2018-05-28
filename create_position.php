<!-- SIGNUP PAGE -->

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
else {

  ?>

  <html>
  <head>
    <title>Create Position - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("companyheader.html");
    });
    </script>
    <script>
    function validatePositionApplicationForm() {
      var industryField = document.forms['positionForm']['industry'];
      var employeeTypeField = document.forms['positionForm']['employeeType'];
      var startDateField = document.forms['positionForm']['startDate'];
      var locationField = document.forms['positionForm']['location'];
      var salaryField = document.forms['positionForm']['salary'];
      var skillsWantedField = document.forms['positionForm']['skillsWanted'];
      var descriptionField = document.forms['positionForm']['description'];
      if (industryField == null || industryField == "" ||
          employeeTypeField == null || employeeTypeField == "" ||
          startDateField == null || startDateField == "" ||
          locationField == null || locationField == "" ||
          salaryField == null || salaryField == "" ||
          skillsWantedField == null || skillsWantedField == "") {
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
      <left class="sectionheader"><h1>Sign Up</h1></left>
      <div class="ui divider"></div><br>

      <p class="requirednote">* Denotes a required field</p><br>

      <h2>Create A New Position</h2>
      <form name="positionForm" onsubmit="return validatePositionApplicationForm()" action="./server/submit_position.php" method="post" id="positionForm">
        <div class="elem" style="display: none">
          <input class="inputbox" type="text" name="companyID" value="<?php echo $_SESSION['id']; ?>" readonly>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Industry: <input class="inputbox" type="text" name="industry"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Job Title / Employee Type: <input class="inputbox" type="text" name="employeeType"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Start Date: <input class="inputbox" type="date" name="startDate"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Location: <input class="inputbox" type="text" name="location"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Salary: <input class="inputbox" type="number" name="salary"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Skills Wanted (separate each skill by a comma): <input class="inputbox" type="text" name="skillsWanted"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Position Description: <input class="inputbox" type="text" name="description"><br><br>
        </div>
        <input class="ui blue button" type="submit" value="Create Position">
      </form>

    </div>
  </body>
  </html>

  <?php
}
?>
