<!-- SIGNUP PAGE -->

<!DOCTYPE HTML>

<?php
require "./server/connectvars.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);

if (!isset($_SESSION['id']) || $_SESSION['type'] != 'Employee') {
  $url = "./index.php";
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
else {
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $positionID = $_GET['id'];
    $title = $_GET['title'];
    $company = $_GET['company'];
    ?>

    <html>
    <head>
      <title>Apply for <?php echo $title; ?> at <?php echo $company; ?> - FindMeAJob</title>
      <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
      <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
      <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
      <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script>
      $(document).ready(function() {
        $("#siteheader").load("employeeheader.html");
      });

      function validateApplicationForm() {
        var resumeField = document.forms['positionForm']['resumeCV'].value;
        var coverLetterField = document.forms['positionForm']['coverLetter'].value;
        var refNameField = document.forms['positionForm']['refname'].value;
        var refEmailField = document.forms['positionForm']['refemail'].value;
        var refPhoneField = document.forms['positionForm']['refphone'].value;
        if (resumeField == null || resumeField == "" ||
        coverLetterField == null || coverLetterField == "" ||
        refNameField == null || refNameField == "" ||
        refEmailField == null || refEmailField == "" ||
        refPhoneField == null || refPhoneField == "") {
          alert("Please fill all required fields before submitting!");
          return false;
        }
        else {
          return true;
        }
      }
      </script>
    </head>
    <body>
      <div class="siteheader" id="siteheader"></div>

      <div class="mainbody">
        <left class="sectionheader"><h1>Apply for <?php echo $title; ?> at <?php echo $company; ?>!</h1></left>
        <div class="ui divider"></div><br>

        <p class="requirednote">* Denotes a required field</p><br>

        <form name="positionForm" onsubmit="return validateApplicationForm()" action="./server/submit_application.php" method="post" id="positionForm">
          <div class="elem" style="display: none">
            <input class="inputbox" type="text" name="applicantID" value="<?php echo $_SESSION['id']; ?>" readonly>
          </div>
          <div class="elem" style="display: none">
            <input class="inputbox" type="text" name="positionID" value="<?php echo $positionID; ?>" readonly>
          </div>
          <div class="elem">
            <span class="requirednote">*</span>
            Resume/CV: <textarea class="inputbox" name="resumeCV" rows="5" cols="40"></textarea>
          </div>
          <div class="elem">
            <span class="requirednote">*</span>
            Cover Letter: <textarea class="inputbox" name="coverLetter" rows="5" cols="40"></textarea>
          </div><br>
          <div class="ui divider"></div><br>
          <h3>Add a Reference!</h3>
          <div class="elem">
            <span class="requirednote">*</span>
            Reference Name: <input class="inputbox" type="number" name="refname"><br><br>
          </div>
          <div class="elem">
            <span class="requirednote">*</span>
            Reference Email: <input class="inputbox" type="number" name="refemail"><br><br>
          </div>
          <div class="elem">
            <span class="requirednote">*</span>
            Reference Phone Number: <input class="inputbox" type="number" name="refphone"><br><br>
          </div>
          <input class="ui blue button" type="submit" value="Apply">
        </form>

      </div>
    </body>
    </html>

    <?php
  }
}
?>
