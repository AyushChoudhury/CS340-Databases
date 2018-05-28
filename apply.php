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
      </script>
      <script>
      function validatePositionApplicationForm() {
        var resumeField = document.forms['CVForm']['resume'];
        var coverLetterField = document.forms['CVForm']['coverletter'];;
        if (resumeField == null || resumeField == "" ||
        coverLetterField == null || coverLetterField == "") {
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
        <left class="sectionheader"><h1>Apply for Position!</h1></left>
        <div class="ui divider"></div><br>

        <p class="requirednote">* Denotes a required field</p><br>

        <h2>Apply for <?php echo $title; ?> at <?php echo $company; ?>!</h2>
        <form name="positionForm" onsubmit="return validatePositionApplicationForm()" action="./server/submit_application.php" method="post" id="CVForm">
          <input class="inputbox" type="text" name="applicantID" value="<?php echo $_SESSION['id']; ?>" style="display: none" readonly>
          <input class="inputbox" type="text" name="positionID" value="<?php echo $positionID; ?>" style="display: none" readonly>
          <div class="elem">
            <span class="requirednote">*</span>
            Resume/CV: <textarea name="resume" rows="5" cols="40" wrap="hard"></textarea>
          </div>
          <div class="elem">
            <span class="requirednote">*</span>
            Cover Letter: <textarea name="coverletter" rows="5" cols="40" wrap="hard"></textarea>
          </div>
          <input class="ui blue button" type="submit" value="Sign Up!">
        </form>

      </div>
    </body>
    </html>

    <?php
  }
}
?>
